<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/framework.css">
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
            <?php require 'header.php'; ?>
            <h1 class="p-relative">Absences</h1>
            <div class="absences p-20 bg-fff rad-10 m-20">
                <h2 class="mt-0 mb-20">Suivi absence</h2>
                <div class="responsive-table">
                    <div class="options w-full">
                        <div class="Inventory-by-date">
                            <label for="day">Jour:</label>
                            <input type="date" name="date" id="day">
                        </div>
                        <div class="branch-filter mt-10 mb-10">
                            <button class="btn-shape bg-c-60 color-fff active mb-10" data-branch="all">Tous</button>
                            <button class="btn-shape bg-c-60 color-fff mb-10" data-branch="1DSI">1DSI</button>
                            <button class="btn-shape bg-c-60 color-fff mb-10" data-branch="1PME">1PME</button>
                            <button class="btn-shape bg-c-60 color-fff mb-10" data-branch="2DSI">2DSI</button>
                            <button class="btn-shape bg-c-60 color-fff mb-10" data-branch="2PME">2PME</button>
                        </div>
                    </div>
                    <table class="fs-15 w-full" id="absence-list">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>CNE</th>
                                <th>Nom complet</th>
                                <th>Classe</th>
                                <th>Date</th>
                                <th>Absence</th>
                                <th>Justification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "SELECT absences.id as absence_id, absences.*, etudiants.CNE, etudiants.numero, utilisateurs.prenom, utilisateurs.nom
                                    FROM absences 
                                    JOIN etudiants ON absences.etudiant_id = etudiants.CNE 
                                    JOIN utilisateurs ON absences.etudiant_id = utilisateurs.identifiant
                                    WHERE utilisateurs.role = 'etudiant' and justification is null";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $total_heures_absence = getTotalHeuresAbsence($row['CNE'], $conn) . "  ";
                                    echo "<tr data-branch='" . $row['classe'] . "' data-date='" . $row['date'] . "'>";
                                    echo "<td>" . $row['CNE'] . "</td>";
                                    echo "<td>" . $row['numero'] . "</td>";
                                    echo "<td>" . $row['prenom'] . " " . $row['nom'] . "</td>";
                                    echo "<td>" . $row['classe'] . "</td>";
                                    echo "<td>" . $row['date'] . "</td>";
                                    echo "<td>" . $row['heures_absence'] . "h</td>";
                                    echo "<td>" . ($row['justification'] ? $row['justification'] : "Non") . "</td>";
                                    $id = $row['absence_id'];
                                    $date = $row['date'];
                                    echo "<td>
                                            <a href='../php/delete_absence.php?id=$id&date=$date' class='supprimer-btn' data-id='" . $row['absence_id'] . "'><span class='label btn-shape bg-f00'>Supprimer</span></a>
                                            <a href='#' class='justification-btn' data-id='" . $row['absence_id'] . "' data-date='" . $row['date'] . "'><span class='label btn-shape bg-green'>Justification</span></a>";

                                    if ($total_heures_absence >= 8 && $total_heures_absence < 16) {
                                        echo "<a href='../php/send_warning.php?id=" . $row['CNE'] . "&warning=1' class='avertissement-btn' data-id='" . $row['CNE'] . "'><span class='label btn-shape bg-ffa500'>1er Avertissement</span></a>";
                                    }
                                    if ($total_heures_absence >= 16 && $total_heures_absence < 24) {
                                        echo "<a href='../php/send_warning.php?id=" . $row['CNE'] . "&warning=2' class='avertissement-btn' data-id='" . $row['CNE'] . "'><span class='label btn-shape bg-ffa500'>2eme Avertissement</span></a>";
                                    }
                                    if ($total_heures_absence >= 24) {
                                        echo "<a href='../php/remove_student.php?id=" . $row['CNE'] . "' class='supprimer-btn' data-id='" . $row['CNE'] . "'><span class='label btn-shape bg-f00'>Supprimer Etudiant</span></a>";
                                    }

                                    echo "<a href='#' class='info-btn' data-id='" . $row['etudiant_id'] . "' data-date='" . $row['date'] . "'><span class='label btn-shape bg-c-60'>Plus Info</span></a>";
                                    echo "</td></tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>Aucune absence trouvée</td></tr>";
                            }

                            $conn->close();

                            function getTotalHeuresAbsence($student_id, $conn)
                            {
                                $sql = "SELECT SUM(heures_absence) as total FROM absences WHERE etudiant_id = ? and justification is null";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $student_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                return $row['total'] ?? 0;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="justification-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Justification pour l'absence</h2>
            <form method="post" action="../php/justify_absence.php" id="justification-form">
                <label for="justification-reason">Sélectionner la justification:</label>
                <select id="justification-reason" name="reason" class="mb-10" required>
                    <option value="">Sélectionner la justification</option>
                    <option value="Malade">Malade</option>
                    <option value="Urgence familiale">Urgence familiale</option>
                    <option value="Rendez-vous medical">Rendez-vous médical</option>
                </select>
                <input type="hidden" id="absence-id" name="absence_id">
                <input type="hidden" id="absence-date" name="absence_date">
                <button type="submit" class="btn-shape bg-c-60 color-fff">Soumettre</button>
            </form>
        </div>
    </div>

    <div id="info-modal" class="modal">
        <div class="modal-content">
            <span class="close-info">&times;</span>
            <h2>Plus d'Information</h2>
            <div id="info-content"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const justificationModal = document.getElementById("justification-modal");

            // Function to open modal
            const openModal = (modal) => {
                modal.style.display = "flex";
            };

            // Function to close modal
            const closeModal = (modal) => {
                modal.style.display = "none";
            };

            // Event listener for justification buttons
            document.querySelectorAll(".justification-btn").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault();
                    const absenceId = button.dataset.id;
                    const absenceDate = button.dataset.date;

                    document.getElementById("absence-id").value = absenceId;
                    document.getElementById("absence-date").value = absenceDate;

                    openModal(justificationModal);
                });
            });

            // Close justification modal
            document.querySelector(".close").addEventListener("click", function() {
                closeModal(justificationModal);
            });

            // Close modal if clicked outside content
            window.addEventListener("click", function(event) {
                if (event.target === justificationModal) {
                    closeModal(justificationModal);
                }
            });

            // Event listener for info buttons
            const infoModal = document.getElementById("info-modal");
            document.querySelectorAll(".info-btn").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault();
                    const row = button.closest("tr");
                    const infoContent = `
                    <p><strong>Total d'heures d'absence:</strong> ${row.cells[5].textContent}</p>
                    <p><strong>Justification:</strong> ${row.cells[6].textContent}</p>
                `;
                    document.getElementById("info-content").innerHTML = infoContent;
                    openModal(infoModal);
                });
            });

            // Close info modal
            document.querySelector(".close-info").addEventListener("click", function() {
                closeModal(infoModal);
            });

            // Close modal if clicked outside info modal
            window.addEventListener("click", function(event) {
                if (event.target === infoModal) {
                    closeModal(infoModal);
                }
            });

            // Event listener for branch filter buttons
            const branchButtons = document.querySelectorAll(".branch-filter button");
            branchButtons.forEach(button => {
                button.addEventListener("click", function() {
                    branchButtons.forEach(btn => btn.classList.remove("active"));
                    button.classList.add("active");

                    const branch = button.getAttribute("data-branch");
                    const rows = document.querySelectorAll("#absence-list tbody tr");

                    rows.forEach(row => {
                        if (branch === "all" || row.getAttribute("data-branch") === branch) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    });
                });
            });

            // Event listener for date input (#day)
            const dayInput = document.getElementById("day");
            dayInput.addEventListener("change", function() {
                const selectedDate = dayInput.value;
                const rows = document.querySelectorAll("#absence-list tbody tr");

                rows.forEach(row => {
                    const rowDate = row.getAttribute("data-date");
                    if (selectedDate === "" || rowDate === selectedDate) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
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