<?php
require "db_connect.php";
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: ../../login.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['date'])) {
    $id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
    $date = htmlspecialchars($_GET['date'], ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("DELETE FROM absences WHERE id = ? AND date = ?");
    $stmt->bind_param("is", $id, $date);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Absence supprimée avec succès";
        $_SESSION['status'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de la suppression de l'absence: " . $stmt->error;
        $_SESSION['status'] = "error";
    }

    $stmt->close();
    $conn->close();

    header("location: ../admin/absence.php");
    exit();
}
else
    header("location: ../admin/absence.php");
?>
