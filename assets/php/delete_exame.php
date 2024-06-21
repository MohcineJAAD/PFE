<?php
session_start();
require 'db_connect.php'; // Adjust the path as needed

if (!isset($_SESSION['user_id'])) {
    header("location: ../../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("DELETE FROM examens WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Examen supprimé avec succès.";
        $_SESSION['status'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de la suppression de l'examen.";
        $_SESSION['status'] = "error";
    }

    // Redirect after processing
    header("location: ../Prof/exames.php");
    exit();
}
?>
