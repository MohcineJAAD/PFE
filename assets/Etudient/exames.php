<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("location: ../../login.php");
    }
    require "../php/db_connect.php";
    $res = $conn->query("SELECT examens.*, modules.name FROM examens
                         JOIN modules ON examens.module_id = modules.id");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/dashbord-prof.css">
    <link rel="stylesheet" href="../css/dashbord.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Tableau d'examen</title>
    <style>

    </style>
</head>
<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <h1 class="p-relative">Tableau d'examen</h1>
            <div class="p-20 bg-fff rad-10 m-20">
                <h2 class="mt-20 mb-20">Liste des DS</h2>
                <div class="test-list" id="test-list">
                    <?php
                        while ($row = $res->fetch_assoc())
                        {
                            $da = $row['date_test'];
                            $na = $row['name'];
                            echo "<div class='test-item'>";
                                echo "<span class='test-date'>$da</span>";
                                echo "<span class='test-name'>$na</span>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
