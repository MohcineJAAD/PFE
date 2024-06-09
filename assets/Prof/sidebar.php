<?php
    $current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar bg-fff p-20 p-relative">
    <h3 class="p-relative txt-c mt-0">B.T.S</h3>
    <ul>
        <li>
            <a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?> d-flex align-c fs-14 color-000 rad-6 p-10">
                <i class="fa-solid fa-chart-simple fa-fw"></i>
                <span class="fs-14 ml-10">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="opEtudient.php" class="<?php echo $current_page == 'opEtudient.php' ? 'active' : ''; ?> d-flex align-c fs-14 color-000 rad-6 p-10">
                <i class="fa-solid fa-user-graduate fa-fw"></i>
                <span class="fs-14 ml-10">Étudient</span>
            </a>
        </li>
        <li>
            <a href="resource.php" class="<?php echo $current_page == 'resource.php' ? 'active' : ''; ?> d-flex align-c fs-14 color-000 rad-6 p-10">
                <i class="fa-solid fa-book-open-reader fa-fw"></i>
                <span class="fs-14 ml-10">Ressources</span>
            </a>
        </li>
        <li>
            <a href="absence.php" class="<?php echo $current_page == 'absence.php' ? 'active' : ''; ?> d-flex align-c fs-14 color-000 rad-6 p-10">
                <i class="fa-solid fa-calendar-xmark fa-fw"></i>
                <span class="fs-14 ml-10">Absence</span>
            </a>
        </li>
        <li>
            <a href="exames.php" class="<?php echo $current_page == 'exames.php' ? 'active' : ''; ?> d-flex align-c fs-14 color-000 rad-6 p-10">
                <i class="fa-solid fa-chalkboard fa-fw"></i>
                <span class="fs-14 ml-10">Tableau d'examen</span>
            </a>
        </li>
    </ul>
</div>