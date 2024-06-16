<!DOCTYPE html>
<html lang="en">

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
    <title>Professeur</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <h1 class="p-relative">Etudients</h1>
            <div class="branch-filter m-20">
                <button class="btn-shape bg-c-60 color-fff" data-branch="all">Tous</button>
                <button class="btn-shape bg-c-60 color-fff" data-branch="DSI1">DSI1</button>
                <button class="btn-shape bg-c-60 color-fff" data-branch="DSI2">DSI2</button>
                <button class="btn-shape bg-c-60 color-fff" data-branch="PME1">PME1</button>
                <button class="btn-shape bg-c-60 color-fff" data-branch="PME2">PME2</button>
            </div>
            <div class="personne-page d-grid m-20 gap-20" id="student-list">
                <div class="personne bg-fff rad-6 p-20 p-relative" data-branch="DSI2">
                    <div class="txt-c">
                        <img class="rad-half w-100 h-100" src="../imgs/default_avatar.png" alt="Prof Image">
                        <h4 class="m-0">Mohcine JAAD</h4>
                    </div>
                    <div class="info fs-14 p-relative">
                        <div class="mb-10">
                            <i class="fa-solid fa-user"></i>
                            <span>Mohcine JAAD</span>
                        </div>
                        <div class="mb-10">
                            <i class="fa-solid fa-phone"></i>
                            <span>0645091298</span>
                        </div>
                        <div class="mb-10">
                            <i class="fa-solid fa-at"></i>
                            <span>mohcine.jaad@gmail.com</span>
                        </div>
                        <div class="mb-10">
                            <i class="fa-solid fa-code-branch"></i>
                            <span>DSI2</span>
                        </div>
                    </div>
                    <div class="action evenly-flex fs-13">
                        <a href="profile-etud.php" class="color-fff bg-c-60 btn-shape">Profile</a>
                        <a href="profile-prof" class="color-fff bg-f00 btn-shape">Retirer</a>
                    </div>
                </div>
                <div class="personne bg-fff rad-6 p-20 p-relative">
                    <div class="add-card rad-6 p-20 p-relative txt-c" id="add-button">
                        <div class="add-content">
                            <div class="circle-dashed">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <p class="mt-10 color-333">Ajouter</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Ajouter un étudiant</h2>
            <form id="addStudentForm" action="create_account.php" method="POST">
                <div class="form-personne">
                    <label for="name" class="mb-10">Nom complet:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-personne">
                    <label for="name" class="mb-10">Nom complet:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-personne">
                    <label for="cne" class="mb-10">CNE:</label>
                    <input type="text" id="cne" name="cne" required>
                </div>
                <div class="form-personne">
                    <label for="password" class="mb-10">Mot de passe:</label>
                    <input type="text" id="password" name="password" readonly>
                </div>
                <div class="form-personne">
                    <label for="branch" class="mb-10">Branche:</label>
                    <select id="branch" name="branch" required>
                        <option value="DSI1">DSI1</option>
                        <option value="DSI2">DSI2</option>
                        <option value="PME1">PME1</option>
                        <option value="PME2">PME2</option>
                    </select>
                </div>
                <div class="action">
                    <button type="submit" class="btn-shape bg-c-60 color-fff" id="add-student">Ajouter</button>
                    <button type="button" class="btn-shape bg-f00 color-fff" id="cancel">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const branchButtons = document.querySelectorAll('.branch-filter button');
            const students = document.querySelectorAll('.personne');
            const modal = document.getElementById("myModal");
            const addButton = document.getElementById("add-button");
            const closeModal = document.querySelector(".close");
            const cancelModal = document.getElementById("cancel");

            branchButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const selectedBranch = this.getAttribute('data-branch');
                    students.forEach(student => {
                        const studentBranch = student.getAttribute('data-branch');
                        if (selectedBranch === 'all' || selectedBranch === studentBranch) {
                            student.classList.remove('hidden');
                        } else {
                            student.classList.add('hidden');
                        }
                    });
                });
            });

            addButton.addEventListener('click', function() {
                modal.style.display = "flex";
                document.getElementById('password').value = generateRandomPassword(8);
            });

            closeModal.addEventListener('click', function() {
                modal.style.display = "none";
            });

            cancelModal.addEventListener('click', function() {
                modal.style.display = "none";
            });

            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
            function generateRandomPassword() {
                const upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                const lowerCase = 'abcdefghijklmnopqrstuvwxyz';
                const numbers = '0123456789';

                const firstChar = upperCase.charAt(Math.floor(Math.random() * upperCase.length));
                const nextThreeChars = Array.from({
                    length: 3
                }, () => lowerCase.charAt(Math.floor(Math.random() * lowerCase.length))).join('');
                const lastFourChars = Array.from({
                    length: 4
                }, () => numbers.charAt(Math.floor(Math.random() * numbers.length))).join('');

                return firstChar + nextThreeChars + lastFourChars;
            }
        });
    </script>
</body>

</html>