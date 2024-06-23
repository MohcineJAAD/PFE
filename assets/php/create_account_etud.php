<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: ../../login.php");
    exit();
}

function splitFullName($fullName) {
    $nameParts = explode(' ', $fullName);
    if (count($nameParts) < 2) {
        return [false, false];
    }
    $firstName = array_shift($nameParts);
    $lastName = implode(' ', $nameParts);
    return [$firstName, $lastName];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = isset($_POST['name']) ? trim($_POST['name']) : '';
    $sex = isset($_POST['sexe']) ? trim($_POST['sexe']) : '';
    $CNE = isset($_POST['identifier']) ? trim($_POST['identifier']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $branch = isset($_POST['branch']) ? trim($_POST['branch']) : '';

    if (empty($fullName)) {
        $_SESSION['toast_message'] = "Le nom complet est requis.";
        $_SESSION['toast_type'] = "error";
    } elseif (empty($sex)) {
        $_SESSION['toast_message'] = "Le genre est requis.";
        $_SESSION['toast_type'] = "error";
    } elseif (empty($CNE)) {
        $_SESSION['toast_message'] = "Le matricule est requis.";
        $_SESSION['toast_type'] = "error";
    } elseif (empty($password)) {
        $_SESSION['toast_message'] = "Le mot de passe est requis.";
        $_SESSION['toast_type'] = "error";
    } elseif (empty($branch)) {
        $_SESSION['toast_message'] = "Le niveau est requis.";
        $_SESSION['toast_type'] = "error";
    } else {
        list($firstName, $lastName) = splitFullName($fullName);

        if (!$firstName || !$lastName) {
            $_SESSION['toast_message'] = "Le nom complet doit contenir au moins un prénom et un nom de famille.";
            $_SESSION['toast_type'] = "error";
        } else {
            // Check for the uniqueness of the identifier
            $stmt = $conn->prepare("SELECT COUNT(*) FROM etudiants WHERE CNE = ?");
            $stmt->bind_param("s", $CNE);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();

            if ($count > 0) {
                $_SESSION['toast_message'] = "Le CNE est déjà utilisé. Etudient deja exist";
                $_SESSION['toast_type'] = "error";
            } else {
                // Determine the section based on the branch value
                $section = (strpos($branch, 'DSI') !== false) ? 'DSI' : 'PME';

                // Begin a transaction
                $conn->begin_transaction();

                try {
                    // Insert into the utilisateurs table
                    $stmt = $conn->prepare("INSERT INTO utilisateurs (identifiant, mot_de_passe, nom, prenom, sexe, role) VALUES (?, ?, ?, ?, ?, 'etudiant')");
                    $stmt->bind_param("sssss", $CNE, $password, $lastName, $firstName, $sex);

                    if (!$stmt->execute()) {
                        throw new Exception($stmt->error);
                    }
                    $stmt->close();

                    // Insert into the professeurs table
                    $stmt = $conn->prepare("INSERT INTO etudiants (CNE, niveau, section) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $CNE, $branch, $section);

                    if (!$stmt->execute()) {
                        throw new Exception($stmt->error);
                    }
                    $stmt->close();

                    // Commit the transaction
                    $conn->commit();

                    $_SESSION['toast_message'] = "Nouveau Etudiant ajouté avec succès!";
                    $_SESSION['toast_type'] = "success";
                } catch (Exception $e) {
                    // Rollback the transaction if any query fails
                    $conn->rollback();

                    $_SESSION['toast_message'] = "Erreur: " . $e->getMessage();
                    $_SESSION['toast_type'] = "error";
                }
            }
        }
    }

    header("Location: ../admin/opEtudient.php");
    exit();
}

$conn->close();
?>
