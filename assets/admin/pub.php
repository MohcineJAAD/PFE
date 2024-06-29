<?php
include("functions.php");

$objet = "";
$content = "";
$event_type = "";

// Handle form submission to insert or update event
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        // Insert new event or update existing event
        if (!empty($_POST['objet']) && !empty($_POST['content']) && !empty($_POST['event_type'])) {
            $objet = $_POST['objet'];
            $content = $_POST['content'];
            $event_type = $_POST['event_type'];
            $status = 'active';

            $conn = getConnection();
            if ($conn) {
                // Handle file upload logic when editing an event
                if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"]) {
                    $target_dir = "uploads/";

                    if (!file_exists($target_dir)) {
                        if (!mkdir($target_dir, 0777, true)) {
                            die("Failed to create directories...");
                        }
                    }

                    $target_file = $target_dir . basename($_FILES["image"]["name"]);

                    // Check file size
                    if ($_FILES["image"]["size"] > 1000000) {
                        echo "Sorry, your file is too large.";
                        exit;
                    }

                    // Attempt to upload file
                    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        echo "Sorry, there was an error uploading your file.";
                        exit;
                    }
                } else {
                    // No new image uploaded, retain the existing image
                    if (isset($_POST['edit_event_id'])) {
                        $edit_event_id = $_POST['edit_event_id'];
                        $query = "SELECT image FROM events WHERE id = :edit_event_id";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(':edit_event_id', $edit_event_id);
                        $stmt->execute();
                        $event = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($event && !empty($event['image'])) {
                            $target_file = $event['image']; // Use existing image path
                        }
                    }
                }

                // Insert or update event into database
                if (!empty($_POST['edit_event_id'])) {
                    // Update existing event
                    $edit_event_id = $_POST['edit_event_id'];
                    $query = "UPDATE events SET objet = :objet, content = :content, event_type = :event_type, image = :image WHERE id = :edit_event_id";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':objet', $objet);
                    $stmt->bindParam(':content', $content);
                    $stmt->bindParam(':event_type', $event_type);
                    $stmt->bindParam(':image', $target_file);
                    $stmt->bindParam(':edit_event_id', $edit_event_id);
                } else {
                    // Insert new event
                    $query = "INSERT INTO events (objet, content, status, date, image, event_type, active) 
                              VALUES (:objet, :content, :status, NOW(), :image, :event_type, 1)";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':objet', $objet);
                    $stmt->bindParam(':content', $content);
                    $stmt->bindParam(':status', $status);
                    $stmt->bindParam(':image', $target_file);
                    $stmt->bindParam(':event_type', $event_type);
                }

                if ($stmt->execute()) {
                    header("Location: pub.php");
                    exit();
                } else {
                    echo "Error adding or updating event: " . implode(", ", $stmt->errorInfo());
                }
            } else {
                echo "Database connection failed.";
            }
        } else {
            echo "Please fill all required fields.";
        }
    } elseif (isset($_POST["delete_event_id"])) {
        // Delete event
        $delete_event_id = $_POST['delete_event_id'];

        $conn = getConnection();
        if ($conn) {
            // Fetch current image path to delete from uploads directory
            $query = "SELECT image FROM events WHERE id = :delete_event_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':delete_event_id', $delete_event_id);
            $stmt->execute();
            $event = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($event && $event['image'] && file_exists($event['image'])) {
                unlink($event['image']); // Delete image file from uploads directory
            }

            // Delete event from database
            $query = "DELETE FROM events WHERE id = :delete_event_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':delete_event_id', $delete_event_id);

            if ($stmt->execute()) {
                header("Location: pub.php");
                exit();
            } else {
                echo "Error deleting event: " . implode(", ", $stmt->errorInfo());
            }
        } else {
            echo "Database connection failed.";
        }
    } elseif (isset($_POST['edit_event_id'])) {
        // Fetch event details for editing
        $edit_event_id = $_POST['edit_event_id'];

        $conn = getConnection();
        if ($conn) {
            $query = "SELECT * FROM events WHERE id = :edit_event_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':edit_event_id', $edit_event_id);
            $stmt->execute();
            $event = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($event) {
                // Assign fetched values to form fields
                $objet = $event['objet'];
                $content = $event['content'];
                $event_type = $event['event_type'];
                // You can also handle image pre-filling if needed
            } else {
                echo "Event not found.";
            }
        } else {
            echo "Database connection failed.";
        }
    }
}

// Function to fetch all events ordered by date DESC
function fetchAllEvents() {
    $conn = getConnection();
    if ($conn) {
        $query = "SELECT * FROM events ORDER BY date DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Database connection failed.";
        return [];
    }
}

// Predefined types for the dropdown (can be fetched from database or hardcoded)
$types = array(
    "inscription" => "Inscription",
    "activite_educative" => "Activité éducative",
    "orientation_scolaire" => "Orientation scolaire",
    "activite_recreative" => "Activité récréative",
    "activite_sportive" => "Activité sportive"
);

// Function to truncate content to limited rows
function truncateContent($content, $rows = 3) {
    $contentRows = explode("\n", $content);
    $truncatedContent = implode("\n", array_slice($contentRows, 0, $rows));
    return $truncatedContent;
}

// Function to generate HTML for each event
function generateEventHTML($event) {
    $contentSnippet = truncateContent($event['content'], 3);
    return '
        <div class="pub bg-fff rad-6 p-relative">
            <img src="' . $event['image'] . '" alt="" class="cover">
            <div class="p-20">
                <h4 class="m-0">' . $event['objet'] . '</h4>
                <p class="description color-888 mt-15 fs-14">' . nl2br($contentSnippet) . '</p>
            </div>
            <div class="info p-15 p-relative between-flex">
                <span class="color-888"><i class="fa-solid fa-calendar-days"></i> ' . date('d/m/Y', strtotime($event['date'])) . '</span>
                <div class="op">
                    <form method="POST" action="pub.php">
                        <input type="hidden" name="edit_event_id" value="' . $event['id'] . '">
                        <button type="submit" class="color-fff bg-c-60 btn-shape"><i class="fa-solid fa-pen"></i> Edit</button>
                    </form>
                    <form method="POST" action="pub.php" onsubmit="return confirm(\'Are you sure you want to delete this event?\')">
                        <input type="hidden" name="delete_event_id" value="' . $event['id'] . '">
                        <button type="submit" class="color-fff bg-f00 btn-shape"><i class="fa-solid fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
    ';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/dashbord.css">
    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Professeur</title>
    <style>
        .pub .cover {
            width: 100%; /* Fixed width for the image */
            height: 200px; /* Fixed height for the image */
            object-fit: cover; /* Ensure the image covers the entire space */
        }
    </style>
</head>
<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <h1 class="p-relative">Publication</h1>
            <div class="pub-page p-20 bg-fff rad-10 m-20">
                <div class="pub-form">
                    <div class="post-creation">
                        <h2 class="mt-0 mb-20">Créer un post</h2>
                        <form id="postForm" action="pub.php" method="POST" enctype="multipart/form-data">
                            <?php if (isset($_POST['edit_event_id'])): ?>
                                <input type="hidden" name="edit_event_id" value="<?php echo $_POST['edit_event_id']; ?>">
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="event_type">Type d'événement</label>
                                <select id="event_type" name="event_type" class="privacy-setting" required>
                                    <option value="">Sélectionner le type</option>
                                    <?php foreach ($types as $key => $label): ?>
                                        <option value="<?php echo $key; ?>" <?php if (isset($_POST['edit_event_id']) && $event['event_type'] == $key) echo 'selected'; ?>><?php echo $label; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="objet">Objet</label>
                                <input type="text" id="objet" name="objet" value="<?php echo htmlspecialchars($objet); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="content">Contenu</label>
                                <textarea id="content" name="content" required><?php echo htmlspecialchars($content); ?></textarea>
                                <div id="charCount">0/500</div>
                            </div>
                            <div class="add-media">
                                <label for="file-upload">Ajouter une photo</label>
                                <input id="file-upload" name="image" type="file" multiple accept="image/*">
                                <div id="fileList"></div>
                            </div>
                            <button name="submit" type="submit">Publier</button>
                        </form>
                    </div>
                </div>
            </div>
            <h2 class="m-20">Tous les posts</h2>
            <div class="display-pub d-grid m-20 gap-20">
                <?php
                // Fetch all events ordered by date DESC
                $events = fetchAllEvents();

                if (!empty($events)) {
                    foreach ($events as $event) {
                        echo generateEventHTML($event);
                    }
                } else {
                    echo "Aucun enregistrement trouvé.";
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const content = document.getElementById('content');
            const charCount = document.getElementById('charCount');
            const fileUpload = document.getElementById('file-upload');
            const fileList = document.getElementById('fileList');

            content.addEventListener('input', () => {
                const length = content.value.length;
                charCount.textContent = `${length}/500`;
                if (length > 500) {
                    content.value = content.value.substring(0, 500);
                }
            });

            fileUpload.addEventListener('change', (event) => {
                fileList.innerHTML = '';
                for (let i = 0; i < fileUpload.files.length; i++) {
                    const file = fileUpload.files[i];
                    const fileItem = document.createElement('div');
                    fileItem.textContent = file.name;
                    fileList.appendChild(fileItem);
                }
            });
        });
    </script>
</body>
</html>
