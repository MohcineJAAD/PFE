<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/dashbord.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Professeur</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <h1 class="p-relative">Professeurs</h1>
            <div class="branch-filter m-20">
                <button class="btn-shape bg-c-60 color-fff" data-branch="all">Tous</button>
                <button class="btn-shape bg-c-60 color-fff" data-branch="1DSI">1DSI</button>
                <button class="btn-shape bg-c-60 color-fff" data-branch="2DSI">2DSI</button>
                <button class="btn-shape bg-c-60 color-fff" data-branch="1PME">1PME</button>
                <button class="btn-shape bg-c-60 color-fff" data-branch="2PME">2PME</button>
            </div>
            <div class="personne-page d-grid m-20 gap-20" id="teacher-list">
                <?php
                $query = "SELECT u.nom, u.prenom, u.identifiant, u.sexe, u.telephone, u.email, p.branche, p.section FROM utilisateurs u JOIN professeurs p ON u.identifiant = p.matricule WHERE u.role = 'prof'";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['nom'] . " " . $row['prenom'];
                        $phone = $row['telephone'] ? $row['telephone'] : "N/A";
                        $email = $row['email'] ? $row['email'] : "N/A";
                        $branch = $row['branche'] ? $row['branche'] : "N/A";
                        $identifiant = urlencode($row['identifiant']);
                        echo "<div class='personne bg-fff rad-6 p-20 p-relative' data-branch='{$branch}'>
                                <div class='txt-c'>
                                    <img class='rad-half w-100 h-100' src='../imgs/default_avatar.png' alt='Prof Image'>
                                    <h4 class='m-0'>{$name}</h4>
                                </div>
                                <div class='info fs-14 p-relative'>
                                    <div class='mb-10'>
                                        <i class='fa-solid fa-user'></i>
                                        <span>{$name}</span>
                                    </div>
                                    <div class='mb-10'>
                                        <i class='fa-solid fa-phone'></i>
                                        <span>{$phone}</span>
                                    </div>
                                    <div class='mb-10'>
                                        <i class='fa-solid fa-at'></i>
                                        <span>{$email}</span>
                                    </div>
                                    <div class='mb-10'>
                                        <i class='fa-solid fa-code-branch'></i>
                                        <span>{$branch}</span>
                                    </div>
                                </div>
                                <div class='action evenly-flex fs-13'>
                                    <a href='profile-prof.php?id={$identifiant}' class='color-fff bg-c-60 btn-shape'>Profile</a>
                                    <a href='../php/delete_prof.php?id={$identifiant}' class='color-fff bg-f00 btn-shape'>Retirer</a>
                                </div>
                            </div>";
                    }
                }
                $conn->close();
                ?>
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
            <h2>Ajouter un Professeur</h2>
            <form id="addTeacherForm" action="../php/create_account_prof.php" method="POST">
                <div class="form-personne">
                    <label for="name" class="mb-10">Nom complet:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-personne">
                    <label for="sexe" class="mb-10">Genre:</label>
                    <select id="sexe" name="sexe" required>
                        <option value="masculin">Masculin</option>
                        <option value="feminin">Feminin</option>
                    </select>
                </div>
                <div class="form-personne">
                    <label for="matricule" class="mb-10">Matricule:</label>
                    <input type="text" id="matricule" name="identifier" required>
                </div>
                <div class="form-personne">
                    <label for="password" class="mb-10">Mot de passe:</label>
                    <input type="text" id="password" name="password" value="" readonly>
                </div>
                <div class="form-personne">
                    <label for="branches" class="mb-10">Branches:</label>
                    <div class="branch-group">
                        <label><input type="checkbox" name="branches[]" value="1DSI"> 1DSI</label>
                        <label><input type="checkbox" name="branches[]" value="2DSI" class="ml-10"> 2DSI</label>
                        <label><input type="checkbox" name="branches[]" value="1PME" class="ml-10"> 1PME</label>
                        <label><input type="checkbox" name="branches[]" value="2PME" class="ml-10"> 2PME</label>
                    </div>
                </div>
                <div class="action">
                    <button type="submit" class="btn-shape bg-c-60 color-fff">Ajouter</button>
                    <button type="button" class="btn-shape bg-f00 color-fff" id="cancel">Annuler</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const branchButtons = document.querySelectorAll('.branch-filter button');
            const professors = document.querySelectorAll('.personne');
            const modal = document.getElementById("myModal");
            const addButton = document.getElementById("add-button");
            const closeModal = document.querySelector(".close");
            const cancelModal = document.getElementById("cancel");

            branchButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const branch = this.getAttribute('data-branch');
                    if (branch === "all") {
                        professors.forEach(professor => {
                            professor.classList.remove('hidden');
                        });
                    } else {
                        professors.forEach(professor => {
                            const profBranch = professor.getAttribute('data-branch');
                            if (profBranch.includes(branch)) {
                                professor.classList.remove('hidden');
                            } else {
                                professor.classList.add('hidden');
                            }
                        });
                    }
                });
            });

            addButton.addEventListener("click", function() {
                modal.style.display = "block";
                document.getElementById("password").value = generateStructuredPassword();
            });

            closeModal.addEventListener("click", function() {
                modal.style.display = "none";
            });

            cancelModal.addEventListener("click", function() {
                modal.style.display = "none";
            });

            window.addEventListener("click", function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });

            function generateStructuredPassword() {
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

            <?php
            if (isset($_SESSION['toast_message'])) {
                $status_message = $_SESSION['toast_message'];
                $status_type = $_SESSION['toast_type'];
                echo "showToast('$status_message', '$status_type');";
                unset($_SESSION['toast_message']);
                unset($_SESSION['toast_type']);
            }
            ?>
        });

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
