<div class="head p-15 between-flex">
    <h2 class="welcomUser">Bonjour, Mohcine jaad</h2>
    <img src="../imgs/default_avatar.png" alt="avatar" id="avatar">
    <div class="drop-menu p-10" id="dropMenu">
        <div class="userHeader mb-5">
            <img src="../imgs/default_avatar.png" alt="avatar" id="avatar">
            <span class="fs-14 m-0">Mohcine</span>
        </div>
        <ul>
            <li>
                <a href="profile.php" class="d-flex align-c fs-14 color-000 rad-6 p-10">
                    <i class="fa-solid fa-user fa-fw"></i>
                    <span class="fs-14 ml-10">Profil</span>
                </a>
            </li>
            <li>
                <a href="alterPass.php" class="d-flex align-c fs-14 color-000 rad-6 p-10">
                    <i class="fa-solid fa-key fa-fw"></i>
                    <span class="fs-14 ml-10">Changer le mot de passe</span>
                </a>
            </li>
            <li class="mt-20">
                <a href="index.php" class="active d-flex align-c fs-14 color-000 rad-6 p-10">
                    <i class="fa-solid fa-right-from-bracket fa-fw"></i>
                    <span class="fs-14 ml-10">Se déconnecter</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const avatar = document.getElementById("avatar");
        const dropMenu = document.getElementById("dropMenu");

        avatar.addEventListener("click", function(event) {
            event.stopPropagation();
            dropMenu.classList.toggle("drop-menu-Active");
        });

        document.addEventListener("click", function(event) {
            if (!dropMenu.contains(event.target) && !avatar.contains(event.target))
                dropMenu.classList.remove("drop-menu-Active");
        });
    });
</script>