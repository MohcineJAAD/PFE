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

function determineSection($branchArray) {
    $sectionMap = [
        '1DSI' => 'DSI',
        '2DSI' => 'DSI',
        '1PME' => 'PME',
        '2PME' => 'PME'
    ];
    
    $sectionSet = [];
    foreach ($branchArray as $branch) {
        if (isset($sectionMap[$branch])) {
            $sectionSet[$sectionMap[$branch]] = true;
        }
    }
    
    if (isset($sectionSet['DSI']) && isset($sectionSet['PME'])) {
        return 'DSI_PME';
    } elseif (isset($sectionSet['DSI'])) {
        return 'DSI';
    } elseif (isset($sectionSet['PME'])) {
        return 'PME';
    }
    
    return null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = isset($_POST['name']) ? trim($_POST['name']) : '';
    $sex = isset($_POST['sexe']) ? trim($_POST['sexe']) : '';
    $matricule = isset($_POST['identifier']) ? trim($_POST['identifier']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $branchArray = isset($_POST['branches']) ? $_POST['branches'] : [];

    if (empty($fullName)) {
        $_SESSION['toast_message'] = "Le nom complet est requis.";
        $_SESSION['toast_type'] = "error";
    } elseif (empty($sex)) {
        $_SESSION['toast_message'] = "Le genre est requis.";
        $_SESSION['toast_type'] = "error";
    } elseif (empty($matricule)) {
        $_SESSION['toast_message'] = "Le matricule est requis.";
        $_SESSION['toast_type'] = "error";
    } elseif (empty($password)) {
        $_SESSION['toast_message'] = "Le mot de passe est requis.";
        $_SESSION['toast_type'] = "error";
    } elseif (empty($branchArray)) {
        $_SESSION['toast_message'] = "Au moins une branche doit être sélectionnée.";
        $_SESSION['toast_type'] = "error";
    } else {
        list($firstName, $lastName) = splitFullName($fullName);

        if (!$firstName || !$lastName) {
            $_SESSION['toast_message'] = "Le nom complet doit contenir au moins un prénom et un nom de famille.";
            $_SESSION['toast_type'] = "error";
        } else {
            // Check for the uniqueness of the identifier
            $stmt = $conn->prepare("SELECT COUNT(*) FROM utilisateurs WHERE identifiant = ?");
            $stmt->bind_param("s", $matricule);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();

            if ($count > 0) {
                $_SESSION['toast_message'] = "Le matricule est déjà utilisé. professeur deja exist";
                $_SESSION['toast_type'] = "error";
            } else {
                // Password is not hashed here
                $branch = implode(', ', $branchArray);
                $section = determineSection($branchArray);

                if ($section === null) {
                    $_SESSION['toast_message'] = "Impossible de déterminer la section.";
                    $_SESSION['toast_type'] = "error";
                } else {
                    // Begin a transaction
                    $conn->begin_transaction();

                    try {
                        // Insert into the utilisateurs table
                        $stmt = $conn->prepare("INSERT INTO utilisateurs (identifiant, mot_de_passe, nom, prenom, sexe, role) VALUES (?, ?, ?, ?, ?, 'prof')");
                        $stmt->bind_param("sssss", $matricule, $password, $lastName, $firstName, $sex);

                        if (!$stmt->execute()) {
                            throw new Exception($stmt->error);
                        }
                        $stmt->close();

                        // Insert into the professeurs table
                        $stmt = $conn->prepare("INSERT INTO professeurs (matricule, branche, section) VALUES (?, ?, ?)");
                        $stmt->bind_param("sss", $matricule, $branch, $section);

                        if (!$stmt->execute()) {
                            throw new Exception($stmt->error);
                        }
                        $stmt->close();

                        // Commit the transaction
                        $conn->commit();

                        $_SESSION['toast_message'] = "Nouveau professeur ajouté avec succès!";
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
    }

    header("Location: ../admin/opProfesseur.php");
    exit();
}

$conn->close();
?>
