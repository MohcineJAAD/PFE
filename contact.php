<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="codecell, tsec, contact, contact us, harsh kapadia, html, css, js, vanilla css">
    <meta name="description" content="A static contact us page for TSEC CodeCell by Harsh Kapadia">
    <meta name="author" content="Harsh Kapadia">

    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/ma.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/master1.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    
    <script defer src="./static/js/account_dropdown.js"></script>
    <script defer src="./static/js/burger_menu_dropdown.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <title>Contactez-nous</title>
</head>

<body>
    <?php require "header.php"; ?>

    <main>
        <div class="title">Contactez-nous</div>
        <div class="title-info">Nous vous répondrons bientôt !</div>

        <form action="https://formsubmit.co/sihamenachid5@gmail.com" method="post" class="form">
            <div class="input-group">
                <input type="text" name="Prénom" id="Prénom" placeholder="Prénom" required>
                <label for="Prénom">Prénom</label>
            </div>
            
            <div class="input-group">
                <input type="text" name="Nom" id="Nom" placeholder="Nom" required>
                <label for="Nom">Nom</label>
            </div>

            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="E-mail" required>
                <label for="email">E-mail</label>
            </div>

            <div class="input-group">
                <input type="text" name="Objet" id="Objet" placeholder="Objet" required>
                <label for="Objet">Objet</label>
            </div>

            <div class="textarea-group">
                <textarea name="message" id="message" rows="5" placeholder="Message" required></textarea>
                <label for="message">Message</label>
            </div>
            <input type="hidden" name="_captcha" value="false">
            <input type="hidden" name="_next" value="https://localhost/php/PFE-main/PFE-main/merci.html">
            <button class="but1" type="submit" id="submit">Envoyer</button>
        </form>
    </main>

    <footer>
        <ion-icon name="logo-facebook" style="font-size: 35px; cursor: pointer;"></ion-icon>
        <ion-icon name="logo-instagram" style="font-size: 35px; cursor: pointer;"></ion-icon>
        <ion-icon name="logo-twitter" style="font-size: 35px; cursor: pointer;"></ion-icon>
        <ion-icon name="logo-youtube" style="font-size: 35px; cursor: pointer;"></ion-icon>
    </footer>

</body>
</html>
