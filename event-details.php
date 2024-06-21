<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/master1.css">
<link rel="stylesheet" href="assets/css/normalize.css">
<link rel="stylesheet" href="assets/css/all.min.css">
<link rel="stylesheet" href="assets/css/event.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
<title>Event Details</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 70%;
        margin: 1rem auto;
        display: flex;
        justify-content: space-between;
    }

    .event-details {
        flex: 0 0 65%;
    }

    .related-events {
        flex: 0 0 30%;
        background-color: #f9f9f9;
        padding: 1rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
    }

    .related-events h3 {
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .card {
        display: flex;
        flex-direction: column;
        margin-bottom: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: scale(1.03);
    }

    .card img {
        width: 100%; 
        height: auto; 
    }

    .card-body {
        padding: 1rem;
    }

    .card-title {
        font-size: 1rem;
        margin-bottom: 0.5rem;
        font-weight: bold; 
    }

    .card-text {
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .card-text small {
        font-size: 0.75rem;
        color: #6c757d;
    }

    .btn {
        width: 100px;
        height: 25px;
        display: inline-block;
        font-weight: 400;
        color: #212529;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        background-color: transparent;
        border: 1px solid transparent;
        padding: 0.5rem 1rem;
        font-size: 0.75rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #0056b3;
        border-color: #004085;
    }
</style>
</head>
<body>

<?php require "header.php"; ?>

<div class="container">
    <div class="event-details">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ebts";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $event_id = $_GET['id'];
            $sql = "SELECT * FROM events WHERE id = $event_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <div class="card">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['objet']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['objet']; ?></h5>
                        <p class="card-text"><?php echo $row['content']; ?></p>
                        <p class="card-text"><small class="text-muted"><?php echo $row['date']; ?></small></p>
                        <a href="event.php" class="btn btn-primary">Retour</a>
                    </div>
                </div>
                <?php
            } else {
                echo "Aucun événement  trouvé.";
            }
        } else {
            echo "ID d'événement non spécifié.";
        }

        $conn->close();
        ?>
    </div>

    <div class="related-events">
        <h3>Sujets similaires</h3>
        <?php
        
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

       
        $event_type = isset($row['event_type']) ? $row['event_type'] : '';

       
        $sql = "SELECT * FROM events WHERE event_type = '$event_type' AND id != $event_id LIMIT 3";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="card">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['objet']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['objet']; ?></h5>
                        <p class="card-text"><?php echo substr($row['content'], 0, 100); ?>...</p>
                        <p class="card-text"><small class="text-muted"><?php echo $row['date']; ?></small></p>
                        <a href="event-details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Lire la suite</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "Aucun événement associé trouvé.";
        }

        $conn->close();
        ?>
    </div>
</div>

</body>
</html>
