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
                            <button class="btn-shape bg-c-60 color-fff active" data-branch="all">Tous</button>
                            <button class="btn-shape bg-c-60 color-fff" data-branch="DSI1">DSI1</button>
                            <button class="btn-shape bg-c-60 color-fff" data-branch="DSI2">DSI2</button>
                            <button class="btn-shape bg-c-60 color-fff" data-branch="PME1">PME1</button>
                            <button class="btn-shape bg-c-60 color-fff" data-branch="PME2">PME2</button>
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
                            <tr data-branch="DSI1" data-date="2024-06-11" data-total-hours="4" data-morning-hours="2" data-evening-hours="2" data-justified="1" data-unjustified="3">
                                <td>1</td>
                                <td>A13000001</td>
                                <td>Alice Dupont</td>
                                <td>DSI1</td>
                                <td>2024-06-01</td>
                                <td>10h</td>
                                <td>Malade</td>
                                <td>
                                    <a href="#" class="supprimer-btn" data-id="A13000001"><span class="label btn-shape bg-f00">Supprimer</span></a>
                                    <a href="#" class="avertissement-btn" data-id="A13000001"><span class="label btn-shape bg-ffa500">Avertissement</span></a>
                                    <a href="#" class="justification-btn" data-id="A13000001"><span class="label btn-shape bg-green">Justification</span></a>
                                    <a href="#" class="info-btn" data-id="A13000001" data-date="2024-06-01"><span class="label btn-shape bg-c-60">Plus Info</span></a>
                                </td>
                            </tr>
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
            <form id="justification-form">
                <label for="justification-reason">Sélectionner la justification:</label>
                <select id="justification-reason" name="reason" class="mb-10" required>
                    <option value="Malade">Malade</option>
                    <option value="Urgence familiale">Urgence familiale</option>
                    <option value="Rendez-vous médical">Rendez-vous médical</option>
                </select>
                <input type="hidden" id="student-id" name="student_id">
                <button type="submit" class="btn-shape bg-c-60 color-fff">Modifier</button>
            </form>
        </div>
    </div>
    <div id="info-modal" class="modal">
        <div class="modal-content">
            <span class="close-info">&times;</span>
            <h2>Informations sur l'absence</h2>
            <div id="info-content">
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modals = {
                justification: document.getElementById("justification-modal"),
                info: document.getElementById("info-modal")
            };

            function closeModal(modal) {
                modal.style.display = "none";
            }

            document.querySelector(".close").addEventListener("click", () => closeModal(modals.justification));
            document.querySelector(".close-info").addEventListener("click", () => closeModal(modals.info));

            window.addEventListener("click", event => {
                if (event.target == modals.justification || event.target == modals.info) {
                    closeModal(event.target);
                }
            });

            document.querySelectorAll(".justification-btn").forEach(button => {
                button.addEventListener("click", event => {
                    event.preventDefault();
                    document.getElementById("student-id").value = button.getAttribute("data-id");
                    modals.justification.style.display = "flex";
                });
            });

            document.querySelectorAll(".info-btn").forEach(button => {
                button.addEventListener("click", event => {
                    event.preventDefault();
                    const row = button.closest("tr");
                    const infoContent = `
                <p><strong>Total d'heures d'absence:</strong> ${row.dataset.totalHours}</p>
                <p><strong>Heures d'absence le matin:</strong> ${row.dataset.morningHours}</p>
                <p><strong>Heures d'absence le soir:</strong> ${row.dataset.eveningHours}</p>
                <p><strong>Absences justifiées:</strong> ${row.dataset.justified}</p>
                <p><strong>Absences non justifiées:</strong> ${row.dataset.unjustified}</p>
            `;
                    document.getElementById("info-content").innerHTML = infoContent;
                    modals.info.style.display = "flex";
                });
            });

            const dateInput = document.querySelector('input[type="date"]');
            dateInput.value = new Date().toISOString().split("T")[0];

            function filterRows(branch, date) {
                document.querySelectorAll("#absence-list tbody tr").forEach(row => {
                    const matchBranch = (branch === "all" || row.dataset.branch === branch);
                    const matchDate = (row.dataset.date === date);
                    row.style.display = (matchBranch && matchDate) ? "" : "none";
                });
            }

            document.querySelectorAll(".branch-filter button").forEach(button => {
                button.addEventListener("click", function() {
                    document.querySelector(".branch-filter .active").classList.remove("active");
                    this.classList.add("active");
                    filterRows(this.dataset.branch, dateInput.value);
                });
            });

            dateInput.addEventListener("change", () => {
                filterRows(document.querySelector(".branch-filter .active").dataset.branch, dateInput.value);
            });

            filterRows("all", dateInput.value);
        });
    </script>
</body>

</html>