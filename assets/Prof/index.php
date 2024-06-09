<?php
$mat = ["EDI", "MCOO", "GL", "FR", "SGBD", "POO", "ENG", "MATH", "GP", "QTM", "AR", "DEV WEB", "TEC", "C/S", "PFE"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/dashbord-prof.css">
    <link rel="stylesheet" href="../css/dashbord.css">
    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet" />
    <title>Dashboard</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <h1 class="p-relative">Dashboard</h1>
            <div class="horaire p-20 bg-fff rad-10 m-20">
                <h2 class="mt-0 mb-20">Emploi temp</h2>
                <div class="responsive-table rad-10">
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
                                    echo "<td colspan='2' class='class-cell'>".$mat[$i]."</td>";
                                    echo "<td colspan='2' class='class-cell empty'></td>";
                                    $i++;
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>