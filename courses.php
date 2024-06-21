<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "ebts";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ressources WHERE type = 'cour'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Référentiel de Formation - Cours</title>
    <link rel="stylesheet" href="assets/css/master1.css" />
    <link rel="stylesheet" href="assets/css/normalize.css" />
    <link rel="stylesheet" href="assets/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/tb.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php require "header.php"; ?>

    <div class="container mt-5">
        <h2>Cours</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Titre</th>
                    <th>Fichier</th>
                    <th>Correction</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['type']; ?></td>
                            <td><?php echo $row['titre']; ?></td>
                            <td>
                                <?php 
                                if (!empty($row['fichier'])) {
                                    
                                    echo "<a href= 'assets/uploadsfich/" . $row["fichier"] . "' download>Télécharger Fichier</a>";
                                } else {
                                    echo 'Fichier non disponible';
                                }
                                ?>
                            </td>
                            <td>
                                <?php 
                                if (!empty($row['correction'])) {
                                   
                                    echo "<a href= 'assets/uploadsfich/" . $row["correction"] . "' download>Télécharger correction</a>";
                                } else {
                                    echo 'Correction non disponible';
                                }
                                ?>
                            </td>
                            <td><?php echo $row['date']; ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5">Aucun fichier trouvé.</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>
