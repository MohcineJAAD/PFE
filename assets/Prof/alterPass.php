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
            <h1 class="p-relative">Changer le mot de passe</h1>
            <div class="profile-container m-20 bg-fff rad-10">
                <div class="profile-header p-20">
                    <img src="../imgs/default_avatar.png" alt="Image de Profil" class="profile-image m-0 mr-10">
                    <div class="profile-info p-20">
                        <h3 class="profile-name m-0">Mohcine Jaad</h3>
                        <p class="profile-title mt-10">Directeur</p>
                    </div>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="p-20">
                    <table class="profile-details">
                        <tr>
                            <th>Mot de passe</th>
                            <td>
                                <div class="password-container">
                                    <input type="password" name="motPass" id="pass">
                                    <img src="../imgs/hide.png" class="toggle-password" id="eye-pass">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Nouveau mot de passe</th>
                            <td>
                                <div class="password-container">
                                    <input type="password" name="newMotPass" id="Npass">
                                    <img src="../imgs/hide.png" class="toggle-password" id="eye-Npass">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Confirmer le mot de passe</th>
                            <td>
                                <div class="password-container">
                                    <input type="password" name="cnewMotPass" id="Cpass">
                                    <img src="../imgs/hide.png" class="toggle-password" id="eye-Cpass">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="save-button">
                        <i class="fas fa-save"></i>Enregistrer
                    </button>
                </form>
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
        togglePassword('Npass', 'eye-Npass');
        togglePassword('Cpass', 'eye-Cpass');
    </script>
</body>

</html>
