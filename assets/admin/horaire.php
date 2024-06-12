<?php
$mat = ["EDI", "MCOO", "GL", "FR", "SGBD", "POO", "ENG", "MATH", "GP", "QTM", "AR", "DEV WEB", "TEC", "C/S", "PFE"];
$prof = ["Pr.EL FAJJAJ", "Pr.SALIHI", "Pr.OMAYMA CHEBBA", "Pr.DAHAR", "Pr.NAAIM", "Pr.EL GHANDOURI MOHAMED", "Pr.HAFID", "Pr.FATIMA ZOHRA"];
$days = ["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <title>Dashboard</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <h1 class="p-relative">L'emploi du temps</h1>
            <div class="accordion-container">
                <?php foreach (["1DSI", "2DSI", "1PME", "2PME"] as $class) : ?>
                    <div class="accordion-item m-20">
                        <div class="accordion-header">
                            <span><?= $class ?></span>
                            <span class="toggle-icon">></span>
                        </div>
                        <div class="accordion-content">
                            <form class="horaire responsive-table">
                                <table>
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
                                        <?php foreach ($days as $day) : ?>
                                            <tr>
                                                <th><?= $day ?></th>
                                                <?php for ($i = 0; $i < 4; $i++) : ?>
                                                    <td colspan="2">
                                                        <select class="subject" disabled>
                                                            <option>--</option>
                                                            <?php foreach ($mat as $value) : ?>
                                                                <option><?= $value ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <select class="professor" disabled>
                                                            <option>--</option>
                                                            <?php foreach ($prof as $value) : ?>
                                                                <option><?= $value ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                <?php endfor; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="action-buttons">
                                    <button type="button" class="edit-btn btn-shape mb-10"><i class="fas fa-edit"></i> Modifier</button>
                                    <button type="button" class="save-btn btn-shape mb-10 hidden"><i class="fas fa-save"></i> Sauvegarder</button>
                                    <button type="button" class="delete-btn btn-shape mb-10"><i class="fas fa-trash"></i> Supprimer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Accordion functionality
            const accordionItems = document.querySelectorAll('.accordion-item');
            accordionItems.forEach(item => {
                const header = item.querySelector('.accordion-header');
                const content = item.querySelector('.accordion-content');
                const icon = header.querySelector('.toggle-icon');

                header.addEventListener('click', function() {
                    const isOpen = content.classList.contains('open');
                    // Close all accordions
                    accordionItems.forEach(acc => {
                        acc.querySelector('.accordion-content').classList.remove('open');
                        acc.querySelector('.toggle-icon').classList.remove('rotate');
                    });
                    // Toggle current accordion
                    if (!isOpen) {
                        content.classList.add('open');
                        icon.classList.add('rotate');
                    } else {
                        content.classList.remove('open');
                        icon.classList.remove('rotate');
                    }
                });
            });

            // Edit and Save functionality
            document.querySelectorAll('.accordion-content form').forEach(form => {
                const editBtn = form.querySelector('.edit-btn');
                const saveBtn = form.querySelector('.save-btn');
                const deleteBtn = form.querySelector('.delete-btn');
                const selectElements = form.querySelectorAll('select');

                // Initially hide the save button
                saveBtn.classList.add('hidden');

                editBtn.addEventListener('click', function() {
                    selectElements.forEach(select => {
                        select.disabled = false;
                        select.classList.add('editable');
                    });
                    editBtn.style.display = 'none'; // Hide the edit button
                    deleteBtn.style.display = 'none'; // Hide the delete button
                    saveBtn.style.display = 'inline-block'; // Show the save button
                });

                saveBtn.addEventListener('click', function() {
                    selectElements.forEach(select => {
                        select.disabled = true;
                        select.classList.remove('editable');
                    });
                    saveBtn.style.display = 'none'; // Hide the save button
                    editBtn.style.display = 'inline-block'; // Show the edit button
                    deleteBtn.style.display = 'inline-block'; // Show the delete button
                });

                deleteBtn.addEventListener('click', function() {
                    selectElements.forEach(select => {
                        select.value = '--';
                    });
                });
            });
        });
    </script>
</body>

</html>