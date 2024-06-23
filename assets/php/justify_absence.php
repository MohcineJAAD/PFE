<?php
require "db_connect.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: ../../login.php");
    exit();
}

if (isset($_POST['reason'], $_POST['absence_date'], $_POST['absence_id'])) {
    $reason = htmlspecialchars($_POST['reason'], ENT_QUOTES, 'UTF-8');
    $date = htmlspecialchars($_POST['absence_date'], ENT_QUOTES, 'UTF-8');
    $id = intval($_POST['absence_id']);

    // Debugging: Log the received data
    error_log("Absence ID: $id, Absence Date: $date, Reason: $reason");

    // Prepare the update query
    $stmt = $conn->prepare("UPDATE absences SET justification = ? WHERE id = ?");
    $stmt->bind_param("si", $reason, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Absence justifiée avec succès";
        $_SESSION['status'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de la justification de l'absence: " . $stmt->error;
        $_SESSION['status'] = "error";
    }

    $stmt->close();
    $conn->close();

    header("location: ../admin/absence.php");
    exit();
} else {
    $_SESSION['message'] = "Les paramètres de justification sont manquants.";
    $_SESSION['status'] = "error";
    header("location: ../admin/absence.php");
    exit();
}
?>
