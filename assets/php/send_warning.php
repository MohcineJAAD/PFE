<?php
    session_start(); // Start the session

    // Check if 'id' and 'warning' are set in the URL
    if(!isset($_GET['id']) || !isset($_GET['warning'])) {
        header("Location: ../admin/absence.php");
        exit(); // Ensure the script stops executing after the redirect
    }

    require "db_connect.php"; // Include database connection file

    $id = $_GET['id'];
    $warning = $_GET['warning'];

    // Use prepared statements to avoid SQL injection
    if($warning == 1) {
        $stmt = $conn->prepare("UPDATE absences SET first_warning_sent = 1 WHERE etudiant_id = ?");
    } elseif($warning == 2) {
        $stmt = $conn->prepare("UPDATE absences SET second_warning_sent = 1 WHERE etudiant_id = ?");
    } else {
        // Handle unexpected warning values
        $_SESSION['message'] = 'Invalid warning type';
        $_SESSION['status'] = 'error';
        header("Location: ../admin/absence.php");
        exit();
    }

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Avertissement envoyé';
            $_SESSION['status'] = 'success';
        } else {
            $_SESSION['message'] = 'Failed to send warning';
            $_SESSION['status'] = 'error';
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = 'Failed to prepare statement';
        $_SESSION['status'] = 'error';
    }

    // Redirect to the absence page
    header("Location: ../admin/absence.php");
    exit();
?>
