<?php
session_start();

require "db_connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}
$id = $_SESSION['user_id'];

$allowedExtensions = ['doc', 'docx', 'ppt', 'pptx', 'pdf'];
$resourceType = $_POST['resource-type'] ?? '';
$title = $_POST['title'] ?? '';
$fileUploaded = !empty($_FILES['resource-file']['name'][0]);
$correctionUploaded = !empty($_FILES['correction-file']['name'][0]);

if ($resourceType === 'none' || empty($title) || !$fileUploaded) {
    $_SESSION['message'] = "Tous les champs sont obligatoires sauf le fichier de correction facultatif.";
    $_SESSION['status'] = "error";
    header("Location: ../Prof/resource.php");
    exit();
}

function validateFile($file, $allowedExtensions) {
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    return in_array($fileExtension, $allowedExtensions);
}

function uploadFile($file, $directory) {
    $fileName = time() . '_' . basename($file['name']);
    $targetFilePath = $directory . $fileName;

    // Ensure the directory exists and is writable
    if (!is_dir($directory) || !is_writable($directory)) {
        error_log('Upload directory does not exist or is not writable: ' . $directory);
        return false;
    }

    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        return $fileName;
    } else {
        // Log detailed error for debugging
        error_log('Failed to move uploaded file. Debug info: ' . print_r($file, true));
    }
    return false;
}

$fileNames = [];
foreach ($_FILES['resource-file']['name'] as $index => $name) {
    $file = [
        'name' => $_FILES['resource-file']['name'][$index],
        'tmp_name' => $_FILES['resource-file']['tmp_name'][$index],
        'error' => $_FILES['resource-file']['error'][$index],
        'size' => $_FILES['resource-file']['size'][$index]
    ];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['message'] = "Erreur de téléchargement du fichier: " . $file['error'];
        $_SESSION['status'] = "error";
        header("Location: ../Prof/resource.php");
        exit();
    }

    if (!validateFile($file, $allowedExtensions)) {
        $_SESSION['message'] = "Extension de fichier invalide.";
        $_SESSION['status'] = "error";
        header("Location: ../Prof/resource.php");
        exit();
    }

    $fileName = uploadFile($file, '../resources/');
    if (!$fileName) {
        $_SESSION['message'] = "Erreur lors du téléchargement du fichier. Vérifiez les journaux pour plus de détails.";
        $_SESSION['status'] = "error";
        header("Location: ../Prof/resource.php");
        exit();
    }
    $fileNames[] = $fileName;
}

$correctionFileName = '';
if ($correctionUploaded) {
    foreach ($_FILES['correction-file']['name'] as $index => $name) {
        $file = [
            'name' => $_FILES['correction-file']['name'][$index],
            'tmp_name' => $_FILES['correction-file']['tmp_name'][$index],
            'error' => $_FILES['correction-file']['error'][$index],
            'size' => $_FILES['correction-file']['size'][$index]
        ];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['message'] = "Erreur de téléchargement du fichier de correction: " . $file['error'];
            $_SESSION['status'] = "error";
            header("Location: ../Prof/resource.php");
            exit();
        }

        if (!validateFile($file, $allowedExtensions)) {
            $_SESSION['message'] = "Extension de fichier de correction invalide.";
            $_SESSION['status'] = "error";
            header("Location: ../Prof/resource.php");
            exit();
        }

        $fileName = uploadFile($file, '../resources/');
        if (!$fileName) {
            $_SESSION['message'] = "Erreur lors du téléchargement du fichier de correction. Vérifiez les journaux pour plus de détails.";
            $_SESSION['status'] = "error";
            header("Location: ../Prof/resource.php");
            exit();
        }
        $correctionFileName = $fileName;
    }
}

$res = $conn->query("select identifiant from utilisateurs where id = $id");
$row = $res->fetch_assoc();
$id = $row['identifiant'];
$res = $conn->query("select id from professeurs where matricule = '$id'");
$row = $res->fetch_assoc();
$id = $row['id'];
$fileNamesString = implode(',', $fileNames);
$sql = "INSERT INTO ressources (type, titre, fichier, correction, date, professeur_id) VALUES ('$resourceType', '$title', '$fileNamesString', '$correctionFileName', NOW(), $id)";
if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "Ressource ajoutée avec succès";
    $_SESSION['status'] = "success";
} else {
    $_SESSION['message'] = "Erreur lors de l'ajoute de ressource: " . $conn->error;
    $_SESSION['status'] = "error";
}

$conn->close();
header("Location: ../Prof/resource.php");
exit();
?>
