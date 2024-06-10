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
    <title>Absences - Student Dashboard</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <h1 class="p-relative">Absences</h1>
            <div class="absences p-20 bg-fff rad-10 m-20">
                <h2 class="mt-0 mb-20">Liste des absences</h2>
                <div class="absence-summary p-20">
                    <h3>Résumé des absences</h3>
                    <p>Total d'absences: <span>3</span></p>
                    <p>Absences justifiées: <span>2</span></p>
                    <p>Absences non justifiées: <span>1</span></p>
                </div>
                <div class="responsive-table">
                    <table class="fs-15 w-full" id="absence-list">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Période</th>
                                <th>N Heure</th>
                                <th>Justification</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-06-01</td>
                                <td>Matin</td>
                                <td>1</td>
                                <td>Certificat médical</td>
                            </tr>
                            <tr>
                                <td>2024-06-15</td>
                                <td>Matin</td>
                                <td>1</td>
                                <td>Aucune</td>
                            </tr>
                            <tr>
                                <td>2024-07-02</td>
                                <td>Matin</td>
                                <td>1</td>
                                <td>Certificat médical</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>