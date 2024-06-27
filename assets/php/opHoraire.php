<?php
require 'db_connect.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $class = $_POST['delete'];

        // Prepare delete query
        $query = "DELETE FROM horaires WHERE classe = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $class);
        $stmt->execute();
        $stmt->close();
    } else {
        $class = $_POST['class'];
        foreach ($_POST['subject'] as $day => $times) {
            foreach ($times as $time => $subject) {
                $timeRange = explode('-', $time);
                $startTime = $timeRange[0];
                $endTime = $timeRange[1];
                $matricule = $_POST['professor'][$day][$time];

                if ($subject === '--' || $matricule === '--') {
                    // Delete entry if either subject or professor is "--"
                    $query = "DELETE FROM horaires WHERE classe = ? AND jour = ? AND heure_debut = ? AND heure_fin = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ssss", $class, $day, $startTime, $endTime);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    // Get professor ID
                    $professorIdQuery = "SELECT id FROM professeurs WHERE matricule = ?";
                    $stmt = $conn->prepare($professorIdQuery);
                    $stmt->bind_param("s", $matricule);
                    $stmt->execute();
                    $stmt->bind_result($professorId);
                    $stmt->fetch();
                    $stmt->close();

                    if ($professorId) {
                        // Insert or update schedule
                        $query = "INSERT INTO horaires (classe, periode, matiere, professeur_id, jour, heure_debut, heure_fin) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?)
                                  ON DUPLICATE KEY UPDATE matiere = VALUES(matiere), professeur_id = VALUES(professeur_id)";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("sssisss", $class, $time, $subject, $professorId, $day, $startTime, $endTime);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
            }
        }
    }

    header("Location: ../admin/horaire.php"); // Redirect to the dashboard or any other page
    exit();
}
?>
