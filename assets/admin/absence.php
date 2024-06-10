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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dateInput = document.querySelector('input[type="date"]');
            var today = new Date();
            var day = today.getDate().toString().padStart(2, '0');
            var month = (today.getMonth() + 1).toString().padStart(2, '0'); // January is 0!
            var year = today.getFullYear();
            var todayString = year + '-' + month + '-' + day;
            dateInput.value = todayString;
        });
    </script>
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
                            <button class="btn-shape bg-c-60 color-fff" data-branch="all">Tous</button>
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
                                <th>Nom du tuteur</th>
                                <th>Téléphone du tuteur</th>
                                <th>Justification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>A13000001</td>
                                <td>Alice Dupont</td>
                                <td>DSI1</td>
                                <td>John Dupont</td>
                                <td>0600000001</td>
                                <td>Malade</td>
                                <td>
                                    <a href="#" class="supprimer-btn" data-id="A13000001"><span class="label btn-shape bg-f00">Supprimer</span></a>
                                    <a href="#" class="avertissement-btn" data-id="A13000001"><span class="label btn-shape bg-ffa500">Avertissement</span></a>
                                    <a href="#" class="justification-btn" data-id="A13000001"><span class="label btn-shape bg-green">Justification</span></a>
                                    <a href="#" class="info-btn" data-id="A13000001" data-date="2024-06-01"><span class="label btn-shape bg-c-60">Plus Info</span></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>A13000002</td>
                                <td>Bob Martin</td>
                                <td>DSI2</td>
                                <td>Jane Martin</td>
                                <td>0600000002</td>
                                <td>Urgence familiale</td>
                                <td>
                                    <a href="#" class="supprimer-btn" data-id="A13000002"><span class="label btn-shape bg-f00">Supprimer</span></a>
                                    <a href="#" class="avertissement-btn" data-id="A13000002"><span class="label btn-shape bg-ffa500">Avertissement</span></a>
                                    <a href="#" class="justification-btn" data-id="A13000002"><span class="label btn-shape bg-green">Justification</span></a>
                                    <a href="#" class="info-btn" data-id="A13000002" data-date="2024-06-01"><span class="label btn-shape bg-c-60">Plus Info</span></a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>A13000003</td>
                                <td>Charlie Brown</td>
                                <td>PME1</td>
                                <td>Richard Brown</td>
                                <td>0600000003</td>
                                <td>Rendez-vous médical</td>
                                <td>
                                    <a href="#" class="supprimer-btn" data-id="A13000003"><span class="label btn-shape bg-f00">Supprimer</span></a>
                                    <a href="#" class="avertissement-btn" data-id="A13000003"><span class="label btn-shape bg-ffa500">Avertissement</span></a>
                                    <a href="#" class="justification-btn" data-id="A13000003"><span class="label btn-shape bg-green">Justification</span></a>
                                    <a href="#" class="info-btn" data-id="A13000003" data-date="2024-06-01"><span class="label btn-shape bg-c-60">Plus Info</span></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
