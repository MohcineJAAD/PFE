<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize form data
    $resourceType = $_POST['resource-type'];
    $title = $_POST['title'];

    // Handle resource file upload
    $resourceFileName = '';
    if ($_FILES['resource-file']['size'] > 0) {
        $resourceFile = $_FILES['resource-file'];
        $resourceFileName = $resourceFile['name'];
        $resourceFileTmp = $resourceFile['tmp_name'];
        $uploadDir = '../uploadsfich/';

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (!move_uploaded_file($resourceFileTmp, $uploadDir . $resourceFileName)) {
            echo json_encode(array("error" => "Erreur lors de l'upload du fichier."));
            exit;
        }
    }

    // Handle correction file upload
    $correctionFileName = '';
    if ($_FILES['correction-file']['size'] > 0) {
        $correctionFile = $_FILES['correction-file'];
        $correctionFileName = $correctionFile['name'];
        $correctionFileTmp = $correctionFile['tmp_name'];
        $uploadDir = '../uploadsfich/';

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (!move_uploaded_file($correctionFileTmp, $uploadDir . $correctionFileName)) {
            echo json_encode(array("error" => "Erreur lors de l'upload du fichier de correction."));
            exit;
        }
    }

    // Insert into database
    $sql = "INSERT INTO ressources (type, titre, fichier, correction, date) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $resourceType, $title, $resourceFileName, $correctionFileName);

    if ($stmt->execute()) {
        echo json_encode(array("message" => "Ressource publiée avec succès."));
    } else {
        echo json_encode(array("error" => "Erreur lors de la publication de la ressource: " . $stmt->error));
    }

    $stmt->close();
}

$conn->close();
?>
