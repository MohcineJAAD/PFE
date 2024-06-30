<?php
session_start();
require '../php/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
}

$toast_message = '';
$toast_type = 'info';
$row = null;

// Fetch user data
$query = "SELECT utilisateurs.*, etudiants.* FROM utilisateurs
          join etudiants on identifiant = CNE";
$result = $conn->query($query);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("User not found.");
}

$image_profil = $row['image_profil'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $prenom = $conn->real_escape_string($_POST['prename']);
    $genre = isset($_POST['sexe']) ? $conn->real_escape_string($_POST['sexe']) : $row['sexe'];
    $email = $conn->real_escape_string($_POST['email']);
    $tele = $conn->real_escape_string($_POST['telephone']);
    $profile_image = $image_profil;

    // Check if an image is uploaded
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $file_type = mime_content_type($_FILES['profile_image']['tmp_name']);
        $allowed_types = ['image/jpeg', 'image/png'];

        if (in_array($file_type, $allowed_types)) {
            $upload_dir = '../imgs/';
            $uploaded_file = $upload_dir . basename($_FILES['profile_image']['name']);

            // Ensure the file does not already exist
            if (!file_exists($uploaded_file)) {
                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploaded_file)) {
                    // Delete the old image if it's not the default avatar
                    if ($profile_image && $profile_image !== '../imgs/default_avatar.png') {
                        unlink($profile_image);
                    }
                    $profile_image = $uploaded_file;
                    $_SESSION['toast_message'] = 'Image de profil mise à jour avec succès.';
                    $_SESSION['toast_type'] = 'success';
                }
            } else {
                $_SESSION['toast_message'] = 'Le fichier existe déjà.';
                $_SESSION['toast_type'] = 'warning';
            }
        } else {
            $_SESSION['toast_message'] = 'Seuls les fichiers JPEG et PNG sont autorisés.';
            $_SESSION['toast_type'] = 'error';
        }
    }

    // Handle profile image deletion
    if (isset($_POST['delete_image'])) {
        if ($profile_image && $profile_image !== '../imgs/default_avatar.png') {
            unlink($profile_image);
            $profile_image = '../imgs/default_avatar.png';
            $_SESSION['toast_message'] = 'Image de profil supprimée avec succès.';
            $_SESSION['toast_type'] = 'success';
        } else {
            $_SESSION['toast_message'] = 'Aucune image à supprimer.';
            $_SESSION['toast_type'] = 'warning';
        }
    }

    // Update user information
    $update_query = "UPDATE utilisateurs SET nom = '$name', prenom = '$prenom', sexe = '$genre', email = '$email', telephone = '$tele', image_profil = '$profile_image' WHERE id = " . $_SESSION['user_id'];
    if ($conn->query($update_query) === TRUE) {
        $_SESSION['toast_message'] = 'Profil mis à jour avec succès.';
        $_SESSION['toast_type'] = 'success';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['toast_message'] = 'Erreur lors de la mise à jour des informations.';
        $_SESSION['toast_type'] = 'error';
    }
}

$image_profil = $row['image_profil'];
?>
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
            <?php require 'header.php'; ?>
            <h1 class="p-relative">Profil</h1>
            <div class="profile-container m-20 bg-fff rad-10">
                <div class="profile-header p-20">
                    <img src="<?php echo $image_profil; ?>" alt="Image de Profil" class="profile-image m-0 mr-10">
                    <div class="profile-info p-20">
                        <h3 class="profile-name m-0"><?php echo $row['prenom'] . ' ' . $row['nom']; ?></h3>
                        <p class="profile-title mt-10">Etudiant</p>
                    </div>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="p-20">
                    <table class="profile-details">
                        <tr>
                            <th colspan="2" class="fs-24">Détails académiques</th>
                        </tr>
                        <tr>
                            <th>Niveau</th>
                            <td><input type="text" name="niveau" value="<?php echo $row['niveau']; ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Date d'admission</th>
                            <td><input type="date" name="date_admission" value="<?php echo $row['date_admission']; ?>" readonly></td>
                        </tr>
                        <tr>
                            <th colspan="2" class="fs-24">Informations personnelles</th>
                        </tr>
                        <tr>
                            <th>Prenom</th>
                            <td><input type="text" name="prename" value="<?php echo $row['prenom']; ?>"></td>
                        </tr>
                        <tr>
                            <th>Nom</th>
                            <td><input type="text" name="name" value="<?php echo $row['nom']; ?>"></td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td>
                                <select name="sexe">
                                    <option value="M" <?php if ($row['sexe'] == 'M') echo 'selected'; ?>>Mâle</option>
                                    <option value="F" <?php if ($row['sexe'] == 'F') echo 'selected'; ?>>Femelle</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td><input type="text" name="telephone" value="<?php echo $row['telephone']; ?>"></td>
                        </tr>
                        <tr>
                            <th>Date de naissance</th>
                            <td><input type="date" name="date_naissance" value="<?php echo $row['date_naissance']; ?>"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="email" name="email" value="<?php echo $row['email'] ? $row['email']: "N/A"; ?>"></td>
                        </tr>
                        <tr>
                            <th>Rôle</th>
                            <td><input type="text" name="role" value="Etudiant" readonly></td>
                        </tr>
                        <tr>
                            <th>CNE</th>
                            <td><input type="text" name="cne" value="<?php echo $row['identifiant']; ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Image de Profil</th>
                            <td>
                                <label for="profile_image">
                                    <i class="fas fa-upload"></i><span>Choisir un fichier</span>
                                </label>
                                <input type="file" id="profile_image" name="profile_image">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class="fs-24">Détails du tuteur</th>
                        </tr>
                        <tr>
                            <th>Prenom</th>
                            <td><input type="text" name="tuteur_prenom" value="<?php echo $row['tuteur_prenom'] ? $row['tuteur_prenom']: "N/A"; ?>"></td>
                        </tr>
                        <tr>
                            <th>Nom</th>
                            <td><input type="text" name="tuteur_name" value="<?php echo $row['tuteur_nom'] ? $row['tuteur_nom']: "N/A"; ?>"></td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <select name="tuteur_sexe">
                                <option value="M" <?php if ($row['tuteur_sexe'] == 'masculin') echo 'selected'; ?>>Mâle</option>
                                <option value="F" <?php if ($row['tuteur_sexe'] == 'feminin') echo 'selected'; ?>>Femelle</option>
                                <option value="F" <?php if ($row['tuteur_sexe'] !== 'masculin' && $row['tuteur_sexe'] !== 'feminin') echo 'selected disabled'; ?>>N/A</option>
                            </select>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td><input type="text" name="tuteur_telephone" value="<?php echo $row['tuteur_telephone'] ? $row['tuteur_telephone']: "N/A"; ?>"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="email" name="tuteur_email" value="<?php echo $row['tuteur_email'] ? $row['tuteur_email']: "N/A"; ?>"></td>
                        </tr>
                        <tr>
                            <th colspan="2" class="fs-24">Détails de l'école précédente</th>
                        </tr>
                        <tr>
                            <th>Nom de l'école</th>
                            <td><input type="text" name="ecole_precedente" value="<?php echo $row['ecole_precedente'] ? $row['ecole_precedente']: "N/A"; ?>"></td>
                        </tr>
                        <tr>
                            <th>Note BAC</th>
                            <td><input type="text" name="note_bac" value="<?php echo $row['note_bac'] ? $row['note_bac']: "N/A"; ?>"></td>
                        </tr>
                    </table>
                    <button type="submit" class="save-button">
                        <i class="fas fa-save"></i>Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>