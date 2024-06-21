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
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <title>Profil</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <?php
                if (!isset($_SESSION['user_id'])) {
                    header("location: ../../login.php");
                }
                $query = "SELECT mot_de_passe, image_profil, nom, prenom, role FROM utilisateurs WHERE id =".$_SESSION['user_id'];
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
            ?>
            <h1 class="p-relative">Changer le mot de passe</h1>
            <div class="profile-container m-20 bg-fff rad-10">
                <div class="profile-header p-20">
                    <img src="<?php echo $row['image_profil']; ?>" alt="Image de Profil" class="profile-image m-0 mr-10">
                    <div class="profile-info p-20">
                        <h3 class="profile-name m-0"><?php echo $row['prenom']." ".$row['nom'];?></h3>
                        <p class="profile-title mt-10"><?php echo $row['role']?></p>
                    </div>
                </div>
                <form action="../php/updateP_Profile.php" method="POST" class="p-20">
                    <table class="profile-details">
                        <tr>
                            <th>Mot de passe</th>
                            <td>
                                <div class="password-container">
                                    <input type="password" name="motPass" id="pass" value="<?php echo $row['mot_de_passe']; ?>" disabled>
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
                    <button type="submit" class="save-button" name="alter">
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
    <script>
        <?php
        if (isset($_SESSION['message'])) {
            $status_message = $_SESSION['message'];
            $status_type = $_SESSION['status'];
            echo "showToast('$status_message', '$status_type');";
            unset($_SESSION['message']);
            unset($_SESSION['status']);
        }
        ?>

        function showToast(message, type) {
            Toastify({
                text: message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: type === "error" ? "#FF3030" : "#2F8C37",
                stopOnFocus: true
            }).showToast();
        }
    </script>
</body>

</html>