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
                <form id="test-form" onsubmit="return addTest()">
                    <div class="mb-20">
                        <label for="test-subject">Nom du test:</label>
                        <select id="test-subject" class="form-control" required>
                            <option value="" disabled selected>Choisissez un Module</option>
                            <option value="POO">POO</option>
                            <option value="DEV WEB">DEV WEB</option>
                        </select>
                    </div>
                    <div class="mb-20">
                        <label for="test-date">Date du test:</label>
                        <input type="date" id="test-date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn mt-20">Enregistrer</button>
                </form>
                <h2 class="mt-20 mb-20">Liste des DS</h2>
                <div class="test-list" id="test-list">
                </div>
            </div>
        </div>
    </div>
    <script>
        function addTest() {
            const testSubjectSelect = document.getElementById('test-subject');
            const testDateInput = document.getElementById('test-date');
            const testList = document.getElementById('test-list');

            const testSubject = testSubjectSelect.value;
            const testDate = testDateInput.value;

            if (testSubject && testDate) {
                const testItem = document.createElement('div');
                testItem.className = 'test-item';
                testItem.innerHTML = `
                    <span class="test-date">${testDate}</span>
                    <span class="test-name">${testSubject}</span>
                    <button class="remove-btn" onclick="removeTest(this)">Supprimer</button>
                `;

                testList.appendChild(testItem);

                testSubjectSelect.value = '';
                testDateInput.value = '';
            } else {
                alert('Veuillez choisir un sujet et une date de test.');
            }

            return false;
        }

        function removeTest(button) {
            const testItem = button.parentElement;
            testItem.remove();
        }
    </script>
</body>
</html>
