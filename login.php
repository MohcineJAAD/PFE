<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="assets/css/master1.css" />
        <link rel="stylesheet" href="assets/css/normalize.css" />
        <link rel="stylesheet" href="assets/css/all.min.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <script src="assets/js/main.js" defer></script>
        <link 
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
            rel="stylesheet"
        />
        <title>E-BTS</title>
    </head>
<body>
    <?php require "header.php"; ?>
    <section class="landing">
        <div class="">
            <form action="" method="post" class="login">
                <h2 class="title">se connecter</h2>
                <div class="input-filde">
                    <label for="user">
                        <i class="fa-regular fa-circle-user"></i>
                        Utilisateur
                    </label>
                    <input type="text" name="userName" id="user" placeholder="Entrez identifiant">
                </div>
                <div class="input-filde">
                    <label for="pass">
                        <i class="fa-solid fa-lock"></i>
                        Mot de Passe
                    </label>
                    <input type="password" name="password" id="pass" placeholder="Entrez mot de passe">
                </div>
                <div class="input-filde">
                    <input type="checkbox" name="display" id="true">
                    <label for="true">Affichage du mot de passe</label>
                </div>
                <p class="alert">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Connexion réservée aux étudiants en BTS uniquement
                </p>
                <input type="submit" value="Se connecter" class="btn solid">
                <p class="login-prob">Si vous rencontrez un problème lors de la connexion, veuillez <span>cliquer içi</span></p>
            </form>
        </div>
    </section>
</body>
</html>