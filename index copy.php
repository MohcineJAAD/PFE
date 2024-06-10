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

    <section class="statistique">
        <div class="box-container">
            <div class="box">
                <i class="fa-solid fa-graduation-cap" style="color: #0075ff;"></i>
                <div class="content">
                    <h3><span class="num" data-target="20">0</span>+</h3>
                    <p>filières</p>
                </div>
            </div>
            <div class="box">
                <i class="fa-solid fa-user-graduate" style="color: #0075ff;"></i>
                <div class="content">
                    <h3><span class="num" data-target="4">0</span>K+</h3>
                    <p>etudient</p>
                </div>
            </div>
            <div class="box">
                <i class="fa-solid fa-building" style="color: #0075ff;"></i>
                <div class="content">
                    <h3><span class="num" data-target="30">0</span>+</h3>
                    <p>centre</p>
                </div>
            </div>
            <div class="box">
                <i class="fa-solid fa-chalkboard-user" style="color: #0075ff;"></i>
                <div class="content">
                    <h3><span class="num" data-target="700">0</span>+</h3>
                    <p>Encadrement</p>
                </div>
            </div>
        </div>
    </section>



    <script>
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
    </script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7HUi X39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEH"></script>


</body>
</html>
