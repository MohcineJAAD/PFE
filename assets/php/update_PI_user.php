<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $id = urldecode($_GET['id']);
    $new_identifiant = $_POST['identifiant'];
    $new_password = $_POST['newMotPass'];

    // Password validation function
    function validatePassword($password) {
        $hasUpperCase = preg_match('/[A-Z]/', $password);
        $hasLowerCase = preg_match('/[a-z]/', $password);
        $hasNumbers = preg_match('/\d/', $password);
        $isValidLength = strlen($password) >= 8 && strlen($password) <= 12;
        $noSpaces = !preg_match('/\s/', $password);
        return $hasUpperCase && $hasLowerCase && $hasNumbers && $isValidLength && $noSpaces;
    }

    if (preg_match('/\s/', $new_identifiant)) {
        $_SESSION['message'] = "Identifiant ne doit pas contenir d'espaces.";
        $_SESSION['status'] = "error";
    } elseif (!empty($new_password) && !validatePassword($new_password)) {
        $_SESSION['message'] = "Le mot de passe doit contenir au moins 8 caractères, inclure des chiffres, des lettres minuscules et majuscules, et ne pas contenir d'espaces.";
        $_SESSION['status'] = "error";
    } else {
        // Update the professeurs table first
        $professeur_query = "UPDATE professeurs SET matricule = ? WHERE matricule = ?";
        $prof_stmt = $conn->prepare($professeur_query);
        $prof_stmt->bind_param("ss", $new_identifiant, $id);

        if ($prof_stmt->execute()) {
            $prof_stmt->close();

            // Update the utilisateurs table
            $query = "UPDATE utilisateurs SET identifiant = ?";
            if (!empty($new_password)) {
                $query .= ", mot_de_passe = ?";
            }
            $query .= " WHERE identifiant = ?";
            
            $stmt = $conn->prepare($query);
            if (!empty($new_password)) {
                $stmt->bind_param("sss", $new_identifiant, $new_password, $id);
            } else {
                $stmt->bind_param("ss", $new_identifiant, $id);
            }

            if ($stmt->execute()) {
                $_SESSION['message'] = "Les informations de profil ont été mises à jour avec succès.";
                $_SESSION['status'] = "success";
            } else {
                $_SESSION['message'] = "Une erreur est survenue lors de la mise à jour des informations de profil.";
                $_SESSION['status'] = "error";
            }

            $stmt->close();
        } else {
            $_SESSION['message'] = "Une erreur est survenue lors de la mise à jour des informations de professeurs.";
            $_SESSION['status'] = "error";
            $prof_stmt->close();
        }
    }

    $conn->close();
    header("Location: ../admin/profile-prof.php?id=" . urlencode($new_identifiant));
    exit();
} else {
    header("Location: ../admin/profile-prof.php");
    exit();
}
?>
