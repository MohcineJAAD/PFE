<?php
// Start session
session_start();

require "../php/db_connect.php";

// Retrieve user ID from the session
$user_id = $_SESSION['user_id'];

// Step 1: Select the identifier from utilisateurs where id = $user_id
$sql = "SELECT identifiant FROM utilisateurs WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $identifier = $row['identifiant'];
    
    // Step 2: Select the id from professeur where matricule = identifier
    $sql = "SELECT id FROM professeurs WHERE matricule = '$identifier'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $professeur_id = $row['id'];
        
        // Step 3: Select all rows related to this professor ID from the 'horaires' table
        $sql = "SELECT * FROM horaires WHERE professeur_id = $professeur_id";
        $result = $conn->query($sql);

        // Initialize an array to hold the schedule
        $schedule = array(
            'lundi' => array_fill(0, 8, ''),
            'mardi' => array_fill(0, 8, ''),
            'mercredi' => array_fill(0, 8, ''),
            'jeudi' => array_fill(0, 8, ''),
            'vendredi' => array_fill(0, 8, ''),
            'samedi' => array_fill(0, 8, '')
        );

        // Populate the schedule array with data from the database
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $day = $row['jour'];
                $start_hour = intval(explode(':', $row['heure_debut'])[0]);
                
                // Determine the time slot index
                if ($start_hour == 8) {
                    $index = 0;
                } elseif ($start_hour == 10) {
                    $index = 2;
                } elseif ($start_hour == 14) {
                    $index = 4;
                } elseif ($start_hour == 16) {
                    $index = 6;
                } else {
                    continue; // skip times that don't match any slot
                }
                
                $schedule[$day][$index] = $row['matiere'];
            }
        } 
    } else {
        echo "No professor found for the given identifier";
    }
} else {
    echo "No user found with the given ID";
}

$conn->close();
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
            <?php require '../admin/header.php'; ?>
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
                                for ($i = 0; $i < 8; $i += 2) {
                                    $class = $schedule[$day][$i];
                                    if ($class == '') {
                                        echo "<td colspan='2' class='class-cell empty'></td>";
                                    } else {
                                        echo "<td colspan='2' class='class-cell'>$class</td>";
                                    }
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
