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
    <title>Professeur</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require '../admin/header.php'; ?>
            <h1 class="p-relative">Absences</h1>
            <div class="absences p-20 bg-fff rad-10 m-20">
                <h2 class="mt-0 mb-20">Suivi absence</h2>
                <form id="absence-form">
                    <div class="mb-20">
                        <label for="class-select">Sélectionnez la classe:</label>
                        <select id="class-select" name="class" class="class-select">
                            <option value="1DSI">1DSI</option>
                            <option value="2DSI">2DSI</option>
                            <option value="1PME">1PME</option>
                            <option value="2PME">2PME</option>
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
                                <tr class="2DSI">
                                    <td>1</td>
                                    <td>Mohcine</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="Matin">Matin</option>
                                            <option value="Soir">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="2DSI">
                                    <td>1</td>
                                    <td>Mohcine</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="2DSI">
                                    <td>1</td>
                                    <td>Mohcine</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="2DSI">
                                    <td>1</td>
                                    <td>Mohcine</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="1DSI">
                                    <td>2</td>
                                    <td>Ahmed</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="1DSI">
                                    <td>2</td>
                                    <td>Ahmed</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="1DSI">
                                    <td>2</td>
                                    <td>Ahmed</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="1DSI">
                                    <td>2</td>
                                    <td>Ahmed</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="1DSI">
                                    <td>2</td>
                                    <td>Ahmed</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="1DSI">
                                    <td>2</td>
                                    <td>Ahmed</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="1PME">
                                    <td>3</td>
                                    <td>Sara</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="1PME">
                                    <td>3</td>
                                    <td>Sara</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="1PME">
                                    <td>3</td>
                                    <td>Sara</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="1PME">
                                    <td>3</td>
                                    <td>Sara</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="1PME">
                                    <td>3</td>
                                    <td>Sara</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="2PME">
                                    <td>3</td>
                                    <td>Sara</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="2PME">
                                    <td>3</td>
                                    <td>Sara</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="2PME">
                                    <td>3</td>
                                    <td>Sara</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="2PME">
                                    <td>3</td>
                                    <td>Sara</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
                                <tr class="2PME">
                                    <td>3</td>
                                    <td>Sara</td>
                                    <td>
                                        <select name="period" class="period-select">
                                            <option value="morning">Matin</option>
                                            <option value="evening">Soir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="hours" class="period-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="absence" class="absence-checkbox">
                                    </td>
                                </tr>
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
</body>

</html>
