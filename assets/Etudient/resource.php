<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("location: ../../login.php");
    }
    require "../php/db_connect.php";
    $res = $conn->query("SELECT * FROM ressources");
?>
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet" />
    <title>Professeur</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <h1 class="p-relative">Ressources</h1>
            <div class="absences p-20 bg-fff rad-10 m-20">
                <div class="responsive-table">
                    <div class="options w-full">
                        <div class="branch-filter mt-10 mb-10">
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="all">Tous</button>
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="exam">Examen National</button>
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="examP">Examen Passage</button>
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="cour">Cour</button>
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="ds">DS</button>
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="tp">TP</button>
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="td">TD</button>
                        </div>
                    </div>
                    <table class="fs-15 w-full" id="absence-list">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Fichier</th>
                                <th>Correction</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="resourceTableBody">
                            <?php while ($row = $res->fetch_assoc()): ?>
                                <tr data-type="<?= $row['type'] ?>">
                                    <td><?= $row['titre'] ?></td>
                                    <td><?= $row['fichier'] ? "<a href='../resources/{$row['fichier']}'>Télécharger</a>" : "--" ?></td>
                                    <td><?= $row['correction'] ? "<a href='../resources/{$row['correction']}'>Télécharger</a>" : "--" ?></td>
                                    <td><?= $row['date'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const resourceTableBody = document.getElementById('resourceTableBody');

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active-filter'));
                    // Add active class to the clicked button
                    button.classList.add('active-filter');

                    const branch = button.dataset.branch;
                    filterTable(branch);
                });
            });

            function filterTable(branch) {
                const rows = resourceTableBody.querySelectorAll('tr');
                rows.forEach(row => {
                    if (branch === 'all' || row.dataset.type === branch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>

</html>
