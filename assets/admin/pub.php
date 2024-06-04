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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet" />
    <title>Professeur</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php'; ?>
        <div class="content w-full">
            <?php require 'header.php'; ?>
            <h1 class="p-relative">Publication</h1>
            <div class="pub-page p-20 bg-fff rad-10 m-20">
                <div class="pub-form">
                    <div class="post-creation">
                        <h2 class="mt-0 mb-20">Créer un post</h2>
                        <form id="postForm" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <select class="privacy-setting">
                                    <option value="public">Public</option>
                                    <option value="onlyme">Etudient</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Objet</label>
                                <input type="text" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea id="content" name="content" required></textarea>
                                <div id="charCount">0/500</div>
                            </div>
                            <div class="add-media">
                                <label for="file-upload">Ajouter photo</label>
                                <input id="file-upload" type="file" multiple accept="image/*">
                                <div id="fileList"></div>
                            </div>
                            <button type="submit">Publier</button>
                        </form>
                    </div>
                </div>
            </div>
            <h2 class="m-20">Tous les posts</h2>
            <div class="display-pub d-grid m-20 gap-20">
                <div class="pub bg-fff rad-6 p-relative">
                    <img src="../imgs/cover.jpg" alt="" class="cover">
                    <div class="p-20">
                        <h4 class="m-0">Début d'inscriptions au BTS</h4>
                        <p class="description color-888 mt-15 fs-14">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="info p-15 p-relative between-flex">
                        <span class="color-888">
                            <i class="fa-solid fa-eye"></i>
                            200
                        </span>
                        <span class="color-888">
                            <i class="fa-solid fa-calendar-days"></i>
                            03/06/2024
                        </span>
                        <div class="op">
                            <span class="color-fff bg-c-60 btn-shape"><i class="fa-solid fa-pen"></i></span>
                            <span class="color-fff bg-f00 btn-shape"><i class="fa-solid fa-trash"></i></span>
                        </div>
                    </div>
                </div>
                <div class="pub bg-fff rad-6 p-relative">
                    <img src="../imgs/cover.jpg" alt="" class="cover">
                    <div class="p-20">
                        <h4 class="m-0">Début d'inscriptions au BTS</h4>
                        <p class="description color-888 mt-15 fs-14">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="info p-15 p-relative between-flex">
                        <span class="color-888">
                            <i class="fa-solid fa-eye"></i>
                            200
                        </span>
                        <span class="color-888">
                            <i class="fa-solid fa-calendar-days"></i>
                            03/06/2024
                        </span>
                        <div class="op">
                            <span class="color-fff bg-c-60 btn-shape"><i class="fa-solid fa-pen"></i></span>
                            <span class="color-fff bg-f00 btn-shape"><i class="fa-solid fa-trash"></i></span>
                        </div>
                    </div>
                </div>
                <div class="pub bg-fff rad-6 p-relative">
                    <img src="../imgs/cover.jpg" alt="" class="cover">
                    <div class="p-20">
                        <h4 class="m-0">Début d'inscriptions au BTS</h4>
                        <p class="description color-888 mt-15 fs-14">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="info p-15 p-relative between-flex">
                        <span class="color-888">
                            <i class="fa-solid fa-eye"></i>
                            200
                        </span>
                        <span class="color-888">
                            <i class="fa-solid fa-calendar-days"></i>
                            03/06/2024
                        </span>
                        <div class="op">
                            <span class="color-fff bg-c-60 btn-shape"><i class="fa-solid fa-pen"></i></span>
                            <span class="color-fff bg-f00 btn-shape"><i class="fa-solid fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const content = document.getElementById('content');
            const charCount = document.getElementById('charCount');
            const fileUpload = document.getElementById('file-upload');
            const fileList = document.getElementById('fileList');

            content.addEventListener('input', () => {
                const length = content.value.length;
                charCount.textContent = `${length}/500`;
                if (length > 500) {
                    content.value = content.value.substring(0, 500);
                }
            });

            fileUpload.addEventListener('change', (event) => {
                fileList.innerHTML = '';
                for (let i = 0; i < fileUpload.files.length; i++) {
                    const file = fileUpload.files[i];
                    const fileItem = document.createElement('div');
                    fileItem.textContent = file.name;
                    fileList.appendChild(fileItem);
                }
            });
        });
    </script>
</body>

</html>