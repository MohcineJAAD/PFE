<?php
session_start();
require "db_connect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM ressources WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Supprimé avec succès";
        $_SESSION['status'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de la suppression";
        $_SESSION['status'] = "error";
    }
    $conn->close();
    header("Location: ../Prof/resource.php");
    exit();
} else {
    $_SESSION['message'] = "ID invalide";
    $_SESSION['status'] = "error";
    header("Location: ../Prof/resource.php");
    exit();
}
?>
