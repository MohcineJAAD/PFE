<?php
session_start();
require "db_connect.php";

$user_id = $_POST['user_id'];
$warning_type = $_POST['warning_type'];

if ($warning_type == 'first') {
    $sql = "UPDATE absences SET first_warning_sent = 0 WHERE etudiant_id = ?";
} else if ($warning_type == 'second') {
    $sql = "UPDATE absences SET second_warning_sent = 0 WHERE etudiant_id = ?";
} else {
    header("Location: ../Etudient/index.php");
    exit();
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();

header("Location: ../Etudient/index.php");
echo $user_id;

$stmt->close();
$conn->close();
?>
