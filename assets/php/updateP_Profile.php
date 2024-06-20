<?php
session_start();
require 'db_connect.php';

$passwordsMatch = true;
if (!isset($_SESSION['user_id'])) {
    header("location: ../../login.php");
}
if (isset($_POST['alter'])) {
    $newPW = $_POST['newMotPass'];
    $validNewPW = $_POST['cnewMotPass'];

    if ($newPW == $validNewPW) {
        $query = "UPDATE utilisateurs SET mot_de_passe ='$newPW' WHERE role = 'admin'";
        $conn->query($query);
        $_SESSION['message'] = "Le mots de passe a été mise à jour avec succès.";
        $_SESSION['status'] = "success";
    } else {
        $_SESSION['message'] = "Les mots de passe ne correspondent pas.";
        $_SESSION['status'] = "error";
    }
    header("Location: ../admin/alterPass.php"); 
    exit();
}
?>
