<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/dashbord.css">
    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet" />
    <title>Professeur</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <h1 class="p-relative">Ressources</h1>
            <div class="pub-page p-20 bg-fff rad-10 m-20">
                <div class="pub-form">
                    <div class="post-creation">
                        <h2 class="mt-0 mb-20">Uploader une Nouvelle Ressource</h2>
                        <form id="postForm" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="resource-type">Type de Ressource</label>
                                <select id="resource-type" class="privacy-setting" name="resource-type">
                                    <option value="none" disabled selected>Type</option>
                                    <option value="exam">Examen National</option>
                                    <option value="examP">Examen Passage</option>
                                    <option value="tp">TP</option>
                                    <option value="td">TD</option>
                                    <option value="ds">DS</option>
                                    <option value="cour">Cour</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Titre</label>
                                <input type="text" id="title" name="title" required>
                            </div>
                            <div class="add-media">
                                <label for="file-upload">Ajouter fichier</label>
                                <input id="file-upload" type="file" name="resource-file" multiple>
                                <div id="fileList"></div>
                            </div>
                            <div class="add-media" id="correction-field" style="display: none;">
                                <h3>Uploader correction</h3>
                                <label for="correction-upload">Ajouter fichier de correction</label>
                                <input id="correction-upload" type="file" name="correction-file" multiple>
                                <div id="correctionList"></div>
                            </div>
                            <button type="submit">Publier</button>
                        </form>
                    </div>
                </div>
            </div>
            <h2 class="m-20">Tous les posts</h2>
            <div class="absences p-20 bg-fff rad-10 m-20">
                <h2 class="mt-0 mb-20">Suivi des Ressource</h2>
                <div class="responsive-table">
                    <div class="options w-full">
                        <div class="branch-filter mt-10 mb-10">
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="all">Tous</button>
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="exam">Examen National</button>
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="examP">Examen Passage</button>
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="cour">Cour</button>
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="ds">DS</button>
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="tp">TP</button>
                            <button class="btn-shape bg-c-60 color-fff filter-btn" data-branch="td">TD</button>
                        </div>
                    </div>
                    <table class="fs-15 w-full" id="absence-list">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Titre</th>
                                <th>Fichier</th>
                                <th>Correction</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="resourceTableBody">
                            <tr data-type="exam">
                                <td>Examen National</td>
                                <td>Mathématiques 2024</td>
                                <td><a href="#">Télécharger</a></td>
                                <td><a href="#">Télécharger</a></td>
                                <td>2024-06-03</td>
                                <td>
                                    <a href="#" class="supprimer-btn" data-id="1">
                                        <span class="label btn-shape bg-f00"><i class="fa-solid fa-trash"></i></span>
                                    </a>
                                </td>
                            </tr>
                            <tr data-type="tp">
                                <td>TP</td>
                                <td>Physique 2024</td>
                                <td><a href="#">Télécharger</a></td>
                                <td></td>
                                <td>2024-06-04</td>
                                <td>
                                    <a href="#" class="supprimer-btn" data-id="2">
                                        <span class="label btn-shape bg-f00"><i class="fa-solid fa-trash"></i></span>
                                    </a>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const resourceType = document.getElementById('resource-type');
            const correctionField = document.getElementById('correction-field');
            const fileUpload = document.getElementById('file-upload');
            const fileList = document.getElementById('fileList');
            const correctionUpload = document.getElementById('correction-upload');
            const correctionList = document.getElementById('correctionList');
            const filterButtons = document.querySelectorAll('.filter-btn');
            const resourceTableBody = document.getElementById('resourceTableBody');

            resourceType.addEventListener('change', (event) => {
                const typesWithCorrection = ['exam', 'examP', 'tp', 'td', 'ds'];
                correctionField.style.display = typesWithCorrection.includes(event.target.value) ? 'block' : 'none';
            });

            fileUpload.addEventListener('change', () => {
                fileList.innerHTML = '';
                Array.from(fileUpload.files).forEach(file => {
                    const fileItem = document.createElement('div');
                    fileItem.textContent = file.name;
                    fileList.appendChild(fileItem);
                });
            });

            correctionUpload.addEventListener('change', () => {
                correctionList.innerHTML = '';
                Array.from(correctionUpload.files).forEach(file => {
                    const fileItem = document.createElement('div');
                    fileItem.textContent = file.name;
                    correctionList.appendChild(fileItem);
                });
            });

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active-filter'));
                    // Add active class to the clicked button
                    button.classList.add('active-filter');

                    const branch = button.dataset.branch;
                    filterTable(branch);
                });
            });

            function filterTable(branch) {
                const rows = resourceTableBody.querySelectorAll('tr');
                rows.forEach(row => {
                    if (branch === 'all' || row.dataset.type === branch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>

</html>
