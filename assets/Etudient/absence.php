<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: ../../login.php");
    exit();
}
require "../php/db_connect.php";

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT identifiant FROM utilisateurs WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$res1 = $stmt->get_result();
$row = $res1->fetch_assoc();
$id = $row['identifiant'];

$stmt2 = $conn->prepare("SELECT * FROM absences WHERE etudiant_id = ?");
$stmt2->bind_param("s", $id);
$stmt2->execute();
$res = $stmt2->get_result();

// Calculate sum of absence hours, count of justified absences, and count of unjustified absences
$stmt3 = $conn->prepare("SELECT 
    SUM(heures_absence) AS sumHa,
    COUNT(CASE WHEN justification IS NOT NULL THEN 1 END) AS justifiedCount,
    COUNT(CASE WHEN justification IS NULL THEN 1 END) AS unjustifiedCount,
    MAX(first_warning_sent) AS first_warning_sent,
    MAX(second_warning_sent) AS second_warning_sent
FROM absences WHERE etudiant_id = ?");
$stmt3->bind_param("s", $id);
$stmt3->execute();
$res3 = $stmt3->get_result();
$summary = $res3->fetch_assoc();

// Determine the warning status
$warning = 'Aucun avertissement';
if ($summary['second_warning_sent'] == 1) {
    $warning = 'Deuxième avertissement';
} elseif ($summary['first_warning_sent'] == 1) {
    $warning = 'Premier avertissement';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/dashbord.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Absences - Student Dashboard</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <h1 class="p-relative">Absences</h1>
            <div class="absences p-20 bg-fff rad-10 m-20">
                <h2 class="mt-0 mb-20">Liste des absences</h2>
                <div class="absence-summary p-20">
                    <h3>Résumé des absences</h3>
                    <p>Total d'heures d'absences: <span><?php echo htmlspecialchars($summary['sumHa']); ?></span></p>
                    <p>Absences justifiées: <span><?php echo htmlspecialchars($summary['justifiedCount']); ?></span></p>
                    <p>Absences non justifiées: <span><?php echo htmlspecialchars($summary['unjustifiedCount']); ?></span></p>
                    <p>Avertissement: <span><?php echo htmlspecialchars($warning); ?></span></p>
                </div>
                <div class="responsive-table">
                    <table class="fs-15 w-full" id="absence-list">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Période</th>
                                <th>N Heure</th>
                                <th>Justification</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $res->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['periode']); ?></td>
                                    <td><?php echo htmlspecialchars($row['heures_absence']); ?></td>
                                    <td><?php echo htmlspecialchars($row['justification'] ? $row['justification'] : "Non justifiée"); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
