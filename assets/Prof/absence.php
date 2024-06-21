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
    <title>Professeur</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require '../admin/header.php'; ?>
            <?php
            if (!isset($_SESSION['user_id'])) {
                header("location: ../../login.php");
                exit();
            }
            
            $query = "SELECT u.*, e.niveau, e.numero FROM utilisateurs u JOIN etudiants e ON u.identifiant = e.CNE WHERE role = 'etudiant'";
            $result = $conn->query($query);
            
            $query1 = "SELECT identifiant FROM utilisateurs WHERE id = " . $_SESSION['user_id'];
            $result1 = $conn->query($query1);
            $row = $result1->fetch_assoc();
            $matricule = $row['identifiant'];
            $query2 = "SELECT branche FROM professeurs WHERE matricule = '$matricule'";
            $result2 = $conn->query($query2);
            $row = $result2->fetch_assoc();
            $string = $row['branche'];
            $array = explode('_', $string);
            ?>
            <h1 class="p-relative">Absences</h1>
            <div class="absences p-20 bg-fff rad-10 m-20">
                <h2 class="mt-0 mb-20">Suivi absence</h2>
                <form id="absence-form" method="post" action="../php/save_absences.php">
                    <div class="mb-20">
                        <label for="class-select">Sélectionnez la classe:</label>
                        <select id="class-select" name="class" class="class-select" required>
                            <?php
                                foreach ($array as $value)
                                    echo "<option value='$value'>$value</option>";
                            ?>
                        </select>
                    </div>
                    <div class="responsive-table">
                        <table class="fs-15 w-full" id="absence-list">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th>Nom complet</th>
                                    <th>Période</th>
                                    <th>N heur</th>
                                    <th>Absence</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $studentId = $row['identifiant'];
                                        echo "<tr class='" . $row['niveau'] . "'>";
                                        echo "<td>" . $row['numero'] . "</td>";
                                        echo "<td>" . $row['prenom'] . " " . $row['nom'] . "</td>";
                                        echo "<td><select name='period[$studentId]' class='period-select' required>";
                                        echo "<option value='Matin'>Matin</option>";
                                        echo "<option value='Soir'>Soir</option>";
                                        echo "</select></td>";
                                        echo "<td><select name='hours[$studentId]' class='hours-select' required>";
                                        echo "<option value='1'>1</option>";
                                        echo "<option value='2'>2</option>";
                                        echo "<option value='3'>3</option>";
                                        echo "<option value='4'>4</option>";
                                        echo "</select></td>";
                                        echo "<td>";
                                        echo "<input type='checkbox' name='absente[]' value='$studentId' class='absence-checkbox'>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn mt-20">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('class-select').addEventListener('change', function(event) {
            const selectedClass = event.target.value;
            const rows = document.querySelectorAll('#absence-list tbody tr');
            rows.forEach(row => {
                if (row.classList.contains(selectedClass)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        document.getElementById('class-select').dispatchEvent(new Event('change'));
    </script>
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
