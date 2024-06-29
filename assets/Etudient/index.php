<?php
// Démarrer la session
session_start();

require "../php/db_connect.php";

// Récupérer l'ID utilisateur de la session
$id = $_SESSION['user_id'];

// Obtenir l'identifiant de l'utilisateur
$res = $conn->query("SELECT identifiant FROM utilisateurs WHERE id = $id");
$row1 = $res->fetch_assoc();
$id = $row1['identifiant'];

// Obtenir le niveau de l'étudiant
$sql = "SELECT niveau FROM etudiants WHERE CNE = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $niveau = $row['niveau'];

    // Sélectionner toutes les lignes de l'emploi du temps de la classe de l'étudiant, y compris le nom du professeur
    $sql = "SELECT h.*, concat('Pr.', prenom, ' ', nom) AS professeur_nom 
            FROM horaires h 
            JOIN professeurs p ON h.professeur_id = p.id 
            JOIN utilisateurs u ON u.identifiant = p.matricule 
            WHERE h.classe = '$niveau'";
    $result = $conn->query($sql);

    // Initialiser un tableau pour contenir l'emploi du temps
    $schedule = array(
        'lundi' => array_fill(0, 8, ''),
        'mardi' => array_fill(0, 8, ''),
        'mercredi' => array_fill(0, 8, ''),
        'jeudi' => array_fill(0, 8, ''),
        'vendredi' => array_fill(0, 8, ''),
        'samedi' => array_fill(0, 8, '')
    );

    // Remplir le tableau de l'emploi du temps avec les données de la base de données
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $day = $row['jour'];
            $start_hour = intval(explode(':', $row['heure_debut'])[0]);

            // Déterminer l'index de la tranche horaire
            if ($start_hour == 8) {
                $index = 0;
            } elseif ($start_hour == 10) {
                $index = 2;
            } elseif ($start_hour == 14) {
                $index = 4;
            } elseif ($start_hour == 16) {
                $index = 6;
            } else {
                continue; // ignorer les heures qui ne correspondent à aucune tranche
            }

            $class_info = $row['matiere'] . " <br> " . $row['professeur_nom'];
            $schedule[$day][$index] = $class_info;
        }
    } else {
        echo "Aucun enregistrement trouvé";
    }

    // Vérifier les avertissements
    $stmt = $conn->prepare("SELECT MAX(first_warning_sent) AS first_warning_sent, MAX(second_warning_sent) AS second_warning_sent FROM absences WHERE etudiant_id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $warning_summary = $res->fetch_assoc();
    $first_warning_sent = $warning_summary['first_warning_sent'];
    $second_warning_sent = $warning_summary['second_warning_sent'];

} else {
    echo "Aucun étudiant trouvé avec l'ID donné";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/dashbord-prof.css">
    <link rel="stylesheet" href="../css/dashbord.css">
    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet" />
    <title>Tableau de bord</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require '../admin/header.php'; ?>
            <h1 class="p-relative">Tableau de bord</h1>
            <div class="horaire p-20 bg-fff rad-10 m-20">
                <h2 class="mt-0 mb-20">Emploi du temps</h2>
                <div class="responsive-table rad-10">
                    <table class="fs-15 w-full">
                        <thead>
                            <tr>
                                <th>Jour/Heure</th>
                                <th colspan="2">8-10</th>
                                <th colspan="2">10-12</th>
                                <th colspan="2">14-16</th>
                                <th colspan="2">16-18</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $days = ["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
                            foreach ($days as $day) {
                                echo "<tr>";
                                echo "<th>$day</th>";
                                for ($i = 0; $i < 8; $i += 2) {
                                    $class = $schedule[$day][$i];
                                    if ($class == '') {
                                        echo "<td colspan='2' class='class-cell empty'></td>";
                                    } else {
                                        echo "<td colspan='2' class='class-cell'>$class</td>";
                                    }
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Le Modal -->
    <div id="warningModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 style="color: #ff9800;"><i class="fa-solid fa-triangle-exclamation" style="font-size: 64px;"></i> Attention!</h2>
            <p id="warningMessage" style="font-size: larger;">
                <?php 
                    if ($second_warning_sent == 1) {
                        echo "Vous avez reçu votre deuxième avertissement.";
                    } elseif ($first_warning_sent == 1) {
                        echo "Vous avez reçu votre premier avertissement.";
                    }
                ?>
            </p>
            <form method="POST" action="../php/acknowledge_warning.php">
                <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                <input type="hidden" name="warning_type" value="<?php echo $second_warning_sent == 1 ? 'second' : 'first'; ?>">
                <button type="submit" class="btn-shape color-fff" style="background-color: #ff9800;"><i class="fas fa-check"></i> Accuser réception</button>
            </form>
        </div>
    </div>

    <script>
        // Obtenir le modal
        var modal = document.getElementById("warningModal");

        // Obtenir l'élément <span> qui ferme le modal
        var span = document.getElementsByClassName("close")[0];

        // Afficher le modal s'il y a un avertissement
        <?php if ($first_warning_sent == 1 || $second_warning_sent == 1): ?>
            modal.style.display = "block";
        <?php endif; ?>

        // Lorsque l'utilisateur clique sur <span> (x), fermer le modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Lorsque l'utilisateur clique n'importe où en dehors du modal, fermer le modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>
