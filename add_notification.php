<?php
include("functions.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
   
    if (!empty($_POST['objet']) && !empty($_POST['type']) && !empty($_POST['content'])) {
        $objet = $_POST['objet'];
        $content = $_POST['content'];
        $type = $_POST['type'];

      
        $conn = getConnection();

      
        if ($_FILES["image"]["name"]) {
            $target_dir = "uploads/";

        
            if (!file_exists($target_dir)) {
                if (!mkdir($target_dir, 0777, true)) {
                    die("Failed to create directories...");
                }
            }

            $target_file = $target_dir . basename($_FILES["image"]["name"]);

         
            if ($_FILES["image"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                exit;
            }

            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
               
                $query = "INSERT INTO notifications (objet, content, type, status, date, image) 
                          VALUES (:objet, :content, :type, 'unread', NOW(), :image)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':objet', $objet);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':type', $type);
                $stmt->bindParam(':image', $target_file);

             
                if ($stmt->execute()) {
                    header("location:index.php");
                } else {
                    echo "Error adding notification: " . implode(", ", $stmt->errorInfo());
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Please select an image file.";
        }
    } else {
        echo "Please fill all required fields.";
    }
}
?>
