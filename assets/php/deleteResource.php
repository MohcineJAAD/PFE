<?php
session_start();
require "db_connect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the resource details
    $res = $conn->query("SELECT fichier, correction FROM ressources WHERE id = $id");
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $file_fichier = $row['fichier'];
        $file_correction = $row['correction'];

        // Full paths to the files
        $file_fichier_path = "../resources/" . $file_fichier;
        $file_correction_path = "../resources/" . $file_correction;

        // Attempt to delete files if they exist
        if (file_exists($file_fichier_path)) {
            unlink($file_fichier_path);
        }
        if (file_exists($file_correction_path)) {
            unlink($file_correction_path);
        }

        // Delete the resource record from the database
        $sql = "DELETE FROM ressources WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Supprimé avec succès";
            $_SESSION['status'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de la suppression";
            $_SESSION['status'] = "error";
        }
    } else {
        $_SESSION['message'] = "Ressource non trouvée";
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
