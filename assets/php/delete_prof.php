<?php
session_start();
require 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Manually delete related records from `ressources` table
        $query0 = "DELETE FROM ressources WHERE professeur_id = (SELECT id FROM professeurs WHERE matricule = ?)";
        $stmt0 = $conn->prepare($query0);
        if (!$stmt0) {
            throw new Exception("Préparation de la première requête échouée: " . $conn->error);
        }
        $stmt0->bind_param("s", $id);
        if (!$stmt0->execute()) {
            throw new Exception("Exécution de la première requête échouée: " . $stmt0->error);
        }
        $stmt0->close();

        // Delete from `professeurs` table
        $query1 = "DELETE FROM professeurs WHERE matricule = ?";
        $stmt1 = $conn->prepare($query1);
        if (!$stmt1) {
            throw new Exception("Préparation de la deuxième requête échouée: " . $conn->error);
        }
        $stmt1->bind_param("s", $id);
        if (!$stmt1->execute()) {
            throw new Exception("Exécution de la deuxième requête échouée: " . $stmt1->error);
        }
        $stmt1->close();

        // Delete from `utilisateurs` table
        $query2 = "DELETE FROM utilisateurs WHERE identifiant = ?";
        $stmt2 = $conn->prepare($query2);
        if (!$stmt2) {
            throw new Exception("Préparation de la troisième requête échouée: " . $conn->error);
        }
        $stmt2->bind_param("s", $id);
        if (!$stmt2->execute()) {
            throw new Exception("Exécution de la troisième requête échouée: " . $stmt2->error);
        }
        $stmt2->close();

        // Commit transaction
        $conn->commit();
        
        $_SESSION['status_message'] = 'Professeur supprimé avec succès';
        $_SESSION['status_type'] = 'success';
    } catch (Exception $e) {
        // Rollback transaction if any query fails
        $conn->rollback();
        
        $_SESSION['status_message'] = 'Erreur lors de la suppression du professeur: ' . $e->getMessage();
        $_SESSION['status_type'] = 'error';
    }
} else {
    $_SESSION['status_message'] = 'Erreur lors de la suppression du professeur: ID non spécifié';
    $_SESSION['status_type'] = 'error';
}

$conn->close();
header("Location: ../admin/opProfesseur.php");
exit();
?>
