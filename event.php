<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="assets/css/master1.css" />
<link rel="stylesheet" href="assets/css/normalize.css" />
<link rel="stylesheet" href="assets/css/all.min.css" />
<link rel="stylesheet" href="assets/css/event.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link 
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" 
    rel="stylesheet"
/>
<title>Events</title>
</head>
<body>

<?php require "header.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-8 cards-container">
        <div class="search-links-container">
                <form method="GET" action="">
                    <div class="search-container">
                        <input type="text" name="search" placeholder="Rechercher.." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                        <button id="srbtn" type="submit" >Confirmer</button>
                    </div>
                </form>
        </div>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ebts";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $limit = 8;
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start = ($page - 1) * $limit;
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $event_type = isset($_GET['event_type']) ? $_GET['event_type'] : '';

            if (!empty($search)) {
                $sql = "SELECT * FROM events WHERE (objet LIKE '%$search%' OR content LIKE '%$search%') ORDER BY date DESC LIMIT $start, $limit";
            } elseif (!empty($event_type)) {
                $sql = "SELECT * FROM events WHERE event_type = '$event_type' ORDER BY date DESC LIMIT $start, $limit";
            } else {
                $sql = "SELECT * FROM events ORDER BY date DESC LIMIT $start, $limit";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="card">
                        <div style="flex: 0 0 35%; background: url('<?php echo $row['image']; ?>') no-repeat center center; background-size: cover;"></div>
                        <div style="flex: 0 0 50%;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['objet']; ?></h5>
                                <p class="card-text"><?php echo substr($row['content'], 0, 100); ?>...</p>
                                <p class="card-text"><small class="text-muted"><?php echo $row['date']; ?></small></p>
                                <a href="event-details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Lire la suite</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="card">
                    <div style="flex: 0 0 50%;"></div>
                    <div style="flex: 0 0 50%;">
                        <div class="card-body">
                            <h5 class="card-title">No events found</h5>
                        </div>
                    </div>
                </div>
                <?php
            }

            $sql = empty($search) ? "SELECT COUNT(id) AS total FROM events" : "SELECT COUNT(id) AS total FROM events WHERE objet LIKE '%$search%' OR content LIKE '%$search%'";
            if (!empty($event_type)) {
                $sql = "SELECT COUNT(id) AS total FROM events WHERE event_type = '$event_type'";
            }
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_pages = ceil($row["total"] / $limit);
            $conn->close();
            ?>
            
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo $search; ?>&event_type=<?php echo $event_type; ?>" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        ?>
                        <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>&event_type=<?php echo $event_type; ?>"><?php echo $i; ?></a></li>
                        <?php
                    }
                    ?>
                    <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo $search; ?>&event_type=<?php echo $event_type; ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="col-4">
           
                <div class="links-container">
                    <a href="?event_type=inscription">Inscription</a>
                    <a href="?event_type=activite_educative">Activité_éducative</a>
                    <a href="?event_type=orientation_scolaire">Orientation_scolaire</a>
                    <a href="?event_type=activite_recreative">Activité_récréative</a>
                    <a href="?event_type=activite_sportive">Activité_sportive</a>
                </div>
           
        </div>
    </div>
</div>
</body>
</html>
