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
    <link 
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" 
        rel="stylesheet"
    />
    <script src="assets/js/main.js" defer></script>
    <title>E-BTS</title>
</head>
<body>
    <?php require "header.php";?>
    <section class="landing">
        <div class="container">
            <div class="ullustration">
                <img src="assets/imgs/ulistration.png" alt="">
            </div>
            <div class="intro-text">
                <h1>Bienvenue sur<br>e-BTS</h1>
                <p>
                    Découvrez l'application BTS Dakhla, votre partenaire idéal pour réussir en DSI et PME au Maroc.
                </p>
                <a href="login.php" class="event-button">Explore</a>
            </div>
        </div>
    </section>


    <!-- <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.num');
            const boxes = document.querySelectorAll('.box');

            function countUp(counter) {
                const target = +counter.getAttribute('data-target');
                const speed = 2000;

                const updateCount = () => {
                    const count = +counter.innerText;
                    const increment = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCount, 15);
                    } else {
                        counter.innerText = target;
                    }
                };

                updateCount();
            }

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        const counter = entry.target.querySelector('.num');
                        if (counter) {
                            countUp(counter);
                        }
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });

            boxes.forEach(box => {
                observer.observe(box);
            });
        });
    </script> -->


</body>
</html>
