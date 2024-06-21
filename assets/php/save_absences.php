<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("location: ../../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class = $_POST['class'];
    $absences = isset($_POST['absente']) ? $_POST['absente'] : [];

    foreach ($absences as $studentId) {
        $date = date('Y-m-d');
        $period = $_POST['period'][$studentId];
        $hours = $_POST['hours'][$studentId];

        // Determine heures_matin and heures_soir based on period
        $heures_matin = $period == 'Matin' ? $hours : 0;
        $heures_soir = $period == 'Soir' ? $hours : 0;

        // Prepare and execute the SQL statement to insert absence record
        $stmt = $conn->prepare("INSERT INTO absences (etudiant_id, classe, date, heures_absence, periode, heures_matin, heures_soir) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssii", $studentId, $class, $date, $hours, $period, $heures_matin, $heures_soir);
        $stmt->execute();
        $stmt->close();
    }

    $_SESSION['message'] = "Absence enregistrée avec succès.";
    $_SESSION['status'] = "success";

    header("location: ../Prof/absence.php");
    exit();
}
?>
