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
                    <img src="../imgs/default_avatar.png" alt="Image de Profil" class="profile-image m-0 mr-10">
                    <div class="profile-info p-20">
                        <h3 class="profile-name m-0">Mohcine Jaad</h3>
                        <p class="profile-title mt-10">Etudient</p>
                    </div>
                </div>
                <div class="p-20 mb-20">
                    <h2 class="mt-0 mb-20">Détails académiques</h2>
                    <table class="profile-details">
                        <tr>
                            <th>Niveau</th>
                            <td>2DSI</td>
                        </tr>
                        <tr>
                            <th>Date d'admission</th>
                            <td>06/06/2024</td>
                        </tr>
                    </table>
                </div>
                <div class="p-20 mb-20">
                    <h2 class="mt-0 mb-20">Informations personnelles</h2>
                    <table class="profile-details">
                        <tr>
                            <th>Prénom</th>
                            <td>MOHCINE</td>
                        </tr>
                        <tr>
                            <th>Nom</th>
                            <td>JAAD</td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td>Mâle</td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td>0634562345</td>
                        </tr>
                        <tr>
                            <th>Date de naissance</th>
                            <td>24/07/2004</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>Mohcine.jaad@gmail.com</td>
                        </tr>
                    </table>
                </div>
                <div class="p-20 mb-20">
                    <h2 class="mt-0 mb-20">Détails du tuteur</h2>
                    <table class="profile-details">
                        <tr>
                            <th>Prénom</th>
                            <td>LHOUSSAINE</td>
                        </tr>
                        <tr>
                            <th>Nom</th>
                            <td>JAAD</td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td>Mâle</td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td>0696268026</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>LHOUSSAINE.jaad@gmail.com</td>
                        </tr>
                    </table>
                </div>
                <div class="p-20 mb-20">
                    <h2 class="mt-0 mb-20">Détails de l'école précédente</h2>
                    <table class="profile-details">
                        <tr>
                            <th>Nom de l'école</th>
                            <td>EL fath</td>
                        </tr>
                        <tr>
                            <th>Note BAC</th>
                            <td>12,28</td>
                        </tr>
                    </table>
                </div>
                <div class="p-20 mb-20">
                    <h2 class="mt-0 mb-20">Informations du compte</h2>
                    <table class="profile-details">
                        <tr>
                            <th>Identifiant</th>
                            <td>
                                <div class="password-container">
                                    <input type="password" name="motPass" id="pass" value="1234" disabled>
                                    <img src="../imgs/hide.png" class="toggle-password" id="eye-pass">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Mot de passe</th>
                            <td>
                                <div class="password-container">
                                    <input type="password" name="newMotPass" id="Npass" value="1234" disabled>
                                    <img src="../imgs/hide.png" class="toggle-password" id="eye-Npass">
                                </div>
                            </td>
                        </tr>
                    </table>
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
        togglePassword('Npass', 'eye-Npass');
    </script>
</body>

</html>