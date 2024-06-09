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
                    </div>
                </div>
                <div class="personne bg-fff rad-6 p-20 p-relative" data-branch="PME2">
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
                            <span>PME2</span>
                        </div>
                    </div>
                    <div class="action evenly-flex fs-13">
                        <a href="profile-etud.php" class="color-fff bg-c-60 btn-shape">Profile</a>
                    </div>
                </div>
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
                    </div>
                </div>
                <div class="personne bg-fff rad-6 p-20 p-relative" data-branch="PME2">
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
                            <span>PME2</span>
                        </div>
                    </div>
                    <div class="action evenly-flex fs-13">
                        <a href="profile-etud.php" class="color-fff bg-c-60 btn-shape">Profile</a>
                    </div>
                </div>
                <div class="personne bg-fff rad-6 p-20 p-relative" data-branch="DSI1">
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
                            <span>DSI1</span>
                        </div>
                    </div>
                    <div class="action evenly-flex fs-13">
                        <a href="profile-etud.php" class="color-fff bg-c-60 btn-shape">Profile</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const branchButtons = document.querySelectorAll('.branch-filter button');

            branchButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const selectedBranch = this.getAttribute('data-branch');

                    const students = document.querySelectorAll('.personne');
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
        });
    </script>
</body>

</html>