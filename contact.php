<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="codecell, tsec, contact, contact us, harsh kapadia, html, css, js, vanilla css">
        <meta name="description" content="A static contact us page for TSEC CodeCell by Harsh Kapadia">
        <meta name="author" content="Harsh Kapadia">

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>    
        <link rel="stylesheet" href="assets/css/navbar.css">
        <link rel="stylesheet" href="assets/css/ma.css">
        <link rel="stylesheet" href="assets/css/footer.css">
        
       
        <link rel="stylesheet" href="assets/css/master1.css" />
        <link rel="stylesheet" href="assets/css/all.min.css" />
        
        <script defer src="./static/js/account_dropdown.js"></script>
        <script defer src="./static/js/burger_menu_dropdown.js"></script>

        <title>TSEC CodeCell</title>
    </head>

    <body>
        <?php require "header.php"; ?>

        <main>
            <div class="title">Contactez-nous</div>
            <div class="title-info">Nous vous répondrons bientôt !</div>

            <form action="" method="" class="form">
            <div class="input-group">
                    <input type="text" name="first_name" id="first-name" placeholder="First name">
                    <label for="first-name">Prénom</label>
                </div>
                
                <div class="input-group">
                    <input type="text" name="last_name" id="last-name" placeholder="Last Name">
                    <label for="last-name">Nom</label>
                </div>

                <div class="input-group">
                    <input type="email" name="e-mail" id="e-mail" placeholder="e-mail">
                    <label for="e-mail" id="email">E-mail</label>
                </div>


                
                <div class="textarea-group">
                    <textarea name="message" id="message" rows="5" placeholder="Message"></textarea>
                    <label for="message">Message</label>
                </div>
                
                    <button class="but1" type="submit">Envoyer</button>
                
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