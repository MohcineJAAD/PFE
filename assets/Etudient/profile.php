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
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="p-20">
                    <table class="profile-details">
                        <tr>
                            <th colspan="2" class="fs-24">Détails académiques</th>
                        </tr>
                        <tr>
                            <th>Niveau</th>
                            <td><input type="text" name="prenom" value="Mohcine" readonly></td>
                        </tr>
                        <tr>
                            <th>Date d'admission</th>
                            <td><input type="date" name="date" value="2004-07-24" readonly></td>
                        </tr>
                        <tr>
                            <th colspan="2" class="fs-24">Informations personnelles</th>
                        </tr>
                        <tr>
                            <th>Prenom</th>
                            <td><input type="text" name="name" value="Mohcine"></td>
                        </tr>
                        <tr>
                            <th>Nom</th>
                            <td><input type="text" name="username" value="Jaad"></td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td><input type="text" name="name" value="Mâle"></td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td><input type="text" name="telephone" value="0676090010"></td>
                        </tr>
                        <tr>
                            <th>Date de naissance</th>
                            <td><input type="date" name="date" value="2004-07-24"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="email" name="email" value="mohcine.jaad@gmail.com"></td>
                        </tr>
                        <tr>
                            <th>Rôle</th>
                            <td><input type="text" name="role" value="Etudient"></td>
                        </tr>
                        <tr>
                            <th>CNE</th>
                            <td><input type="text" name="role" value="A130000001"></td>
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
                            <td><input type="text" name="name" value="LHOUSSAINE"></td>
                        </tr>
                        <tr>
                            <th>Nom</th>
                            <td><input type="text" name="username" value="Jaad"></td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td><input type="text" name="name" value="Mâle"></td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td><input type="text" name="telephone" value="0696268026"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="email" name="email" value="LHOUSSAINE.jaad@gmail.com"></td>
                        </tr>
                        <tr>
                            <th colspan="2" class="fs-24">Détails de l'école précédente</th>
                        </tr>
                        <tr>
                            <th>Nom de l'école</th>
                            <td><input type="text" name="name" value="EL fath"></td>
                        </tr>
                        <tr>
                            <th>Note BAC</th>
                            <td><input type="text" name="username" value="12,28"></td>
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