<?php

require '../php/db_connect.php';



$toast_message = '';
$toast_type = 'info';
$row = null;

// Fetch user data
$query = "SELECT u.* FROM utilisateurs u WHERE u.role = 'admin'";
$result = $conn->query($query);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("User not found.");
}

$image_profil = isset($row['image_profil']) ? $row['image_profil'] : '../imgs/default_avatar.png';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $prenom = $conn->real_escape_string($_POST['name']);
    $genre = $conn->real_escape_string($_POST['sexe']);
    $email = $conn->real_escape_string($_POST['email']);
    $fixe = $conn->real_escape_string($_POST['fixe']);
    $role = $conn->real_escape_string($_POST['role']);
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
                    $toast_message = 'Image de profil mise à jour avec succès.';
                    $toast_type = 'success';
                }
            } else {
                $toast_message = 'Le fichier existe déjà.';
                $toast_type = 'warning';
            }
        } else {
            $toast_message = 'Seuls les fichiers JPEG et PNG sont autorisés.';
            $toast_type = 'error';
        }
    }

    // Handle profile image deletion
    if (isset($_POST['delete_image'])) {
        if ($profile_image && $profile_image !== '../imgs/default_avatar.png') {
            unlink($profile_image);
            $profile_image = '../imgs/default_avatar.png';
            $toast_message = 'Image de profil supprimée avec succès.';
            $toast_type = 'success';
        } else {
            $toast_message = 'Aucune image à supprimer.';
            $toast_type = 'warning';
        }
    }

    // Update user information
    $update_query = "UPDATE utilisateurs SET nom = '$username', prenom = '$prenom', sexe = '$genre', email = '$email', telephone = '$fixe', role = '$role', image_profil = '$profile_image' WHERE role = 'admin'";
    if ($conn->query($update_query) === TRUE) {
        // Redirect to the same page to prevent form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $toast_message = 'Erreur lors de la mise à jour des informations.';
        $toast_type = 'error';
    }
}

$image_profil = isset($row['image_profil']) ? $row['image_profil'] : '../imgs/default_avatar.png';
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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
                    <img src="<?php echo htmlspecialchars($image_profil); ?>" alt="Image de Profil" class="profile-image m-0 mr-10">
                    <div class="profile-info p-20">
                        <h3 class="profile-name m-0">Mohcine Jaad</h3>
                        <p class="profile-title mt-10">Directeur</p>
                    </div>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" class="p-20">
                    <table class="profile-details">
                        <tr>
                            <th>Nom</th>
                            <td><input type="text" name="username" value="<?php echo htmlspecialchars($row['nom']); ?>"></td>
                        </tr>
                        <tr>
                            <th>Prenom</th>
                            <td><input type="text" name="name" value="<?php echo htmlspecialchars($row['prenom']); ?>"></td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td><input type="text" name="sexe" value="<?php echo htmlspecialchars($row['sexe']); ?>"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"></td>
                        </tr>
                        <tr>
                            <th>Téléphone fixe</th>
                            <td><input type="text" name="fixe" value="<?php echo htmlspecialchars($row['telephone']); ?>"></td>
                        </tr>
                        <tr>
                            <th>Rôle</th>
                            <td><input type="text" name="role" value="<?php echo htmlspecialchars($row['role']); ?>"></td>
                        </tr>
                        <tr>
                            <th>Image de Profil</th>
                            <td>
                                <label for="profile_image" class="file-input-label">
                                    <i class="fas fa-upload"></i><span>Choisir un fichier</span>
                                    <input type="file" id="profile_image" name="profile_image" accept=".jpg, .jpeg, .png">
                                </label>
                                <button type="submit" class="save-button" name="delete_image">
                                    <i class="fas fa-trash"></i> Supprimer l'image
                                </button>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="save-button">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>
    <?php if ($toast_message) : ?>
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>
            Toastify({
                text: "<?php echo $toast_message; ?>",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "<?php echo $toast_type === 'success' ? '#4caf50' : ($toast_type === 'warning' ? '#ff9800' : '#f44336'); ?>",
            }).showToast();
        </script>
    <?php endif; ?>
</body>

</html>