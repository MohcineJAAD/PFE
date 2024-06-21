<?php
session_start();
require 'db_connect.php'; // Adjust the path as needed

if (!isset($_SESSION['user_id'])) {
    header("location: ../../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['test-subject']) && isset($_POST['test-date'])) {
    $professeur_id = $_SESSION['user_id'];
    $module_id = $_POST['test-subject']; // Assuming 'test-subject' is the module ID
    $date_test = $_POST['test-date'];

    $stmt = $conn->prepare("INSERT INTO examens (date_test, professeur_id, module_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $date_test, $professeur_id, $module_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Examen publié avec succès.";
        $_SESSION['status'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de la publication de l'examen.";
        $_SESSION['status'] = "error";
    }

    header("location: ../Prof/exames.php");
    exit();
} else {
    $_SESSION['message'] = "Tous les champs ne sont pas remplis.";
    $_SESSION['status'] = "error";
    header("location: ../Prof/exames.php");
    exit();
}
?>