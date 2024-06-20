<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/dashbord.css">
    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet" />
    <title>Profil</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require '../admin/header.php'; ?>
            <h1 class="p-relative">Profil</h1>
            <div class="profile-container m-20 bg-fff rad-10">
                <div class="profile-header p-20">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = urldecode($_GET['id']);
                        $stmt = $conn->prepare("SELECT u.nom, u.prenom, u.email, u.telephone, u.date_naissance, u.sexe, u.role, u.identifiant, u.mot_de_passe, u.image_profil, e.* FROM utilisateurs u JOIN etudiants e ON u.identifiant = e.CNE WHERE u.identifiant = ?");
                        $stmt->bind_param("s", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $name = $row['prenom'] . " " . $row['nom'];
                            $email = $row['email'] ? $row['email'] : "N/A";
                            $phone = $row['telephone'] ? $row['telephone'] : "N/A";
                            $dob = $row['date_naissance'] ? $row['date_naissance'] : "N/A";
                            $da = $row['date_admission'] ? $row['date_admission'] : "N/A";
                            $gender = $row['sexe'];
                            $role = $row['role'];
                            $branch = $row['niveau'];
                            $Section = $row['section'];
                            $identifiant = $row['identifiant'];
                            $mot_de_passe = $row['mot_de_passe'];
                            $image = $row['image_profil'];
                        } else {
                            echo "<h3 class='profile-name m-0'>Information non disponible</h3>";
                        }
                        $stmt->close();
                    } else {
                        echo "<h3 class='profile-name m-0'>Identifiant non fourni</h3>";
                    }
                    ?>
                    <img src="<?php echo $image ?>" alt="Image de Profil" class="profile-image m-0 mr-10">
                    <div class="profile-info p-20">
                        <?php
                        echo "<h3 class='profile-name m-0'>$name</h3>";
                        echo "<p class='profile-title mt-10'>$role</p>";
                        ?>
                    </div>
                </div>
                <div class="p-20 mb-20">
                    <h2 class="mt-0 mb-20">Détails académiques</h2>
                    <table class="profile-details">
                        <tr>
                            <th>Section</th>
                            <td><?php echo $Section;?></td>
                        </tr>
                        <tr>
                            <th>Niveau</th>
                            <td><?php echo $branch;?></td>
                        </tr>
                        <tr>
                            <th>Date d'admission</th>
                            <td><?php echo $da;?></td>
                        </tr>
                    </table>
                </div>
                <div class="p-20 mb-20">
                    <h2 class="mt-0 mb-20">Informations personnelles</h2>
                    <table class="profile-details">
                        <tr>
                            <th>Prénom</th>
                            <td><?php echo $row['prenom'];?></td>
                        </tr>
                        <tr>
                            <th>Nom</th>
                            <td><?php echo $row['nom'];?></td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td><?php echo $gender;?></td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td><?php echo $phone;?></td>
                        </tr>
                        <tr>
                            <th>Date de naissance</th>
                            <td><?php echo $dob;?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $email;?></td>
                        </tr>
                    </table>
                </div>
                <div class="p-20 mb-20">
                    <h2 class="mt-0 mb-20">Détails du tuteur</h2>
                    <table class="profile-details">
                        <tr>
                            <th>Prénom</th>
                            <td><?php echo $row['tuteur_prenom']?$row['tuteur_prenom']:"N/A";?></td>
                        </tr>
                        <tr>
                            <th>Nom</th>
                            <td><?php echo $row['tuteur_nom']?$row['tuteur_nom']:"N/A";?></td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td><?php echo $row['tuteur_sexe']?$row['tuteur_sexe']:"N/A";?></td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td><?php echo $row['tuteur_telephone']?$row['tuteur_telephone']:"N/A";?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $row['tuteur_email']?$row['tuteur_email']:"N/A";?></td>
                        </tr>
                    </table>
                </div>
                <div class="p-20 mb-20">
                    <h2 class="mt-0 mb-20">Détails de l'école précédente</h2>
                    <table class="profile-details">
                        <tr>
                            <th>Nom de l'école</th>
                            <td><?php echo $row['ecole_precedente']?$row['ecole_precedente']:"N/A";?></td>
                        </tr>
                        <tr>
                            <th>Note BAC</th>
                            <td><?php echo $row['note_bac']?$row['note_bac']:"N/A";?></td>
                        </tr>
                    </table>
                </div>
                <div class="p-20 mb-20">
                    <h2 class="mt-0 mb-20">Informations du compte</h2>
                    <form action="../php/update_PI_etud.php?id=<?php echo urlencode($id); ?>" method="POST" id="profile-form">
                        <table class="profile-details">
                            <tr>
                                <th>Identifiant</th>
                                <td><?php echo $identifiant; ?></td>
                            </tr>
                            <tr>
                                <th>Mot de passe</th>
                                <td>
                                    <div class="password-container">
                                        <input type="password" name="currentPass" id="pass" value="<?php echo $mot_de_passe; ?>" style="padding: 0;" disabled>
                                        <img src="../imgs/hide.png" class="toggle-password" id="eye-pass">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const togglePassword = (inputId, eyeId) => {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(eyeId);
            eye.addEventListener("click", function() {
                if (input.type === "password") {
                    input.type = "text";
                    this.src = "../imgs/show.png";
                } else {
                    input.type = "password";
                    this.src = "../imgs/hide.png";
                }
            });
        };

        togglePassword('pass', 'eye-pass');
    </script>
</body>

</html>