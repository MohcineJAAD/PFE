<?php
$mat = ["EDI", "MCOO", "GL", "FR", "SGBD", "POO", "ENG", "MATH", "GP", "QTM", "AR", "DEV WEB", "TEC", "C/S", "PFE"];
$prof = ["Pr.EL FAJJAJ", "Pr.SALIHI", "Pr.OMAYMA CHEBBA", "Pr.DAHAR", "Pr.NAAIM", "Pr.EL GHANDOURI MOHAMED", "Pr.HAFID", "Pr.FATIMA ZOHRA"];
?>
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet" />
    <title>Dashboard</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <h1 class="p-relative">L'emploi du temps</h1>
            <div class="horaire p-20 bg-fff rad-10 m-20">
                <h2 class="mt-0 mb-20">1DSI</h2>
                <form class="responsive-table">
                    <table class="fs-15 w-full">
                        <thead>
                            <tr>
                                <th>Jour/Heure</th>
                                <th colspan="2">8-10</th>
                                <th colspan="2">10-12</th>
                                <th colspan="2">14-16</th>
                                <th colspan="2">16-18</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $days = ["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
                            foreach ($days as $day) {
                                echo "<tr>";
                                echo "<th>$day</th>";
                                for ($i = 0; $i < 4; $i++) {
                                    echo "<td colspan='2'>";
                                    echo "<select class='subject' disabled>";
                                    echo "<option>--</option>";
                                    foreach ($mat as $value)
                                        echo "<option>" . $value . "</option>";
                                    echo "</select>";
                                    echo "<select class='professor' disabled>";
                                    echo "<option>--</option>";
                                    foreach ($prof as $value)
                                        echo "<option>" . $value . "</option>";
                                    echo "</select>";
                                    echo "</td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="action-buttons">
                        <button type="button" class="edit-btn btn-shape mb-10"><i class="fas fa-edit"></i>Modifier</button>
                        <button type="button" class="save-btn btn-shape mb-10"><i class="fas fa-save"></i>sauvegarder</button>
                        <button type="button" class="delete-btn btn-shape mb-10"><i class="fas fa-trash"></i>Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const editBtn = document.querySelector('.edit-btn');
        const saveBtn = document.querySelector('.save-btn');
        const deleteBtn = document.querySelector('.delete-btn');

        editBtn.addEventListener('click', function () {
            const selectElements = document.querySelectorAll('select');
            selectElements.forEach(select => {
                select.disabled = false;
                select.classList.add('editable');
            });
            editBtn.style.display = 'none';
            deleteBtn.style.display = 'none';
            saveBtn.style.display = 'inline-block';
        });

        saveBtn.addEventListener('click', function () {
            const selectElements = document.querySelectorAll('select');
            selectElements.forEach(select => {
                select.disabled = true;
                select.classList.remove('editable');
            });
            saveBtn.style.display = 'none';
            editBtn.style.display = 'inline-block';
            deleteBtn.style.display = 'inline-block';
        });

        deleteBtn.addEventListener('click', function () {
            const selectElements = document.querySelectorAll('select');
            selectElements.forEach(select => {
                select.value = '--';
            });
        });

        window.addEventListener('load', function () {
            saveBtn.style.display = 'none';
        });
    </script>
</body>

</html>
