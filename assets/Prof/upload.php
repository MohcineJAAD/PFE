<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebts";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $formType = $_POST['resource-type'];
    $title = $_POST['title'];
    
    // Map form value to database value
    $typeMapping = [
        "exam" => "Examen National",
        "examP" => "Examen de Passage",
        "tp" => "TP",
        "td" => "TD",
        "ds" => "DS",
        "cour" => "Cour"
    ];
    
    if (array_key_exists($formType, $typeMapping)) {
        $type = $typeMapping[$formType];
    } else {
        die("Invalid resource type.");
    }
    
    // Handle file uploads
    $resourceFile = $_FILES['resource-file'];
    $correctionFile = $_FILES['correction-file'];
    
    $resourceFileName = '';
    $correctionFileName = '';
    
    if ($resourceFile['error'] == UPLOAD_ERR_OK) {
        $resourceFileName = basename($resourceFile['name']);
        $targetPath = "../uploadsfich/" . $resourceFileName;
        if (!move_uploaded_file($resourceFile['tmp_name'], $targetPath)) {
            die("Error uploading resource file.");
        }
    }
    
    if ($correctionFile['error'] == UPLOAD_ERR_OK) {
        $correctionFileName = basename($correctionFile['name']);
        $targetPath = "../uploadsfich/" . $correctionFileName;
        if (!move_uploaded_file($correctionFile['tmp_name'], $targetPath)) {
            die("Error uploading correction file.");
        }
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO ressources (type, titre, fichier, correction, date) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $type, $title, $resourceFileName, $correctionFileName);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Ressource uploaded successfully."]);
    } else {
        echo json_encode(["error" => "Error uploading resource: " . $stmt->error]);
    }
    
    $stmt->close();
    $conn->close();
}
?>
