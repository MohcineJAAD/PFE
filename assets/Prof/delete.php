<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebts";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the resource ID to delete
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

// SQL to delete a record from the 'ressources' table
$sql = "DELETE FROM ressources WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    $response = ["message" => "Resource deleted successfully"];
    echo json_encode($response);
} else {
    $response = ["error" => "Error deleting resource: " . $conn->error];
    echo json_encode($response);
}

$conn->close();
?>
