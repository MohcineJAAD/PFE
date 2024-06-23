<?php
session_start();
require 'db_connection.php';

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    $sql = "DELETE FROM etudiants WHERE CNE = ?";
    $sql2 = "DELETE FROM utilisateurs WHERE CNE = ?";
    $sql3 = "DELETE FROM absences WHERE etudiant_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_id);
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("s", $student_id);
    $stmt = $conn->prepare($sql3);
    $stmt->bind_param("s", $student_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Étudiant supprimé avec succès!";
        $_SESSION['status'] = "success";
    } else {
        $_SESSION['message'] = "Échec de la suppression de l'étudiant.";
        $_SESSION['status'] = "error";
    }

    $stmt->close();
    $conn->close();
}

header("location: ../admin/absence.php");
?>
