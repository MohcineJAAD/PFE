<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/dashbord-prof.css">
    <link rel="stylesheet" href="../css/dashbord.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <title>Tableau d'examen</title>
    <style>

    </style>
</head>
<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require '../admin/header.php'; ?>
            <h1 class="p-relative">Tableau d'examen</h1>
            <div class="p-20 bg-fff rad-10 m-20">
                <h2 class="mt-0 mb-20">Ajouter une Devoir surveillé</h2>
                <form id="test-form" method="POST" action="../php/insert_exame.php">
                    <div class="mb-20">
                        <label for="test-subject">Nom du test:</label>
                        <select id="test-subject" class="form-control" name="test-subject" required>
                            <option value="" disabled selected>Choisissez un Module</option>
                            <?php
                                $result = $conn->query("SELECT * from modules");
                                while($row = $result->fetch_assoc())
                                    echo"<option value='".$row['id']."'>".$row['name']."</option>";
                            ?>
                        </select>
                    </div>
                    <div class="mb-20">
                        <label for="test-date">Date du test:</label>
                        <input type="date" id="test-date" class="form-control" name="test-date" required>
                    </div>
                    <button type="submit" class="btn mt-20">Enregistrer</button>
                </form>
                <h2 class="mt-20 mb-20">Liste des DS</h2>
                <div class="test-list" id="test-list">
                    <?php
                        $result = $conn->query("SELECT * from examens");
                        while($row = $result->fetch_assoc())
                        {
                            $result1 = $conn->query("SELECT * from modules where id = ".$row['module_id']);
                            $row1 = $result1->fetch_assoc();
                                echo "<div class='test-item'>";
                                    echo "<span class='test-date'>".$row['date_test']."</span>";
                                    echo "<span class='test-name'>".$row1['name']."</span>";
                                    echo "<a href='../php/delete_exame.php?id=".$row['id']."' class='remove-btn'>"."Supprimer"."</a>";
                                echo "</div>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        <?php
        if (isset($_SESSION['message'])) {
            $status_message = $_SESSION['message'];
            $status_type = $_SESSION['status'];
            echo "showToast('$status_message', '$status_type');";
            unset($_SESSION['message']);
            unset($_SESSION['status']);
        }
        ?>

        function showToast(message, type) {
            Toastify({
                text: message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: type === "error" ? "#FF3030" : "#2F8C37",
                stopOnFocus: true
            }).showToast();
        }
    </script>
</body>
</html>
