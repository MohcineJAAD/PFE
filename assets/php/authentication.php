<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifiant = trim($_POST['userName']);
    $password = trim($_POST['password']);

    // Check if inputs are empty
    if (empty($identifiant) || empty($password)) {
        $_SESSION['error_message'] = "Identifiant ou mot de passe incorrect";
        header("Location: ../../login.php");
        exit();
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, role, nom, prenom, mot_de_passe FROM utilisateurs WHERE identifiant = ?");
    $stmt->bind_param("s", $identifiant);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $role, $nom, $prenom, $stored_password);
        $stmt->fetch();

        // Verify password directly
        if ($password === $stored_password) {
            unset($_SESSION['error_message']);

            // Set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;
            $_SESSION['user_name'] = htmlspecialchars("$prenom $nom", ENT_QUOTES, 'UTF-8');

            // Update last_login timestamp
            $update_stmt = $conn->prepare("UPDATE utilisateurs SET last_login = NOW() WHERE id = ?");
            $update_stmt->bind_param("i", $id);
            $update_stmt->execute();
            $update_stmt->close();

            // Redirect based on role
            switch ($role) {
                case 'admin':
                    header("Location: ../admin");
                    break;
                case 'prof':
                    header("Location: ../Prof");
                    break;
                case 'etudiant':
                    header("Location: ../Etudient");
                    break;
                default:
                    header("Location: ../../login.php");
                    break;
            }
            exit();
        } else {
            $_SESSION['error_message'] = "Identifiant ou mot de passe incorrect";
            header("Location: ../../login.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Identifiant ou mot de passe incorrect";
        header("Location: ../../login.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
