<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<header>
    <div class="container">
        <a href="index.php" class="logo">
            <img src="assets/imgs/logo.svg" alt="logo">
        </a>

        <nav>
            <ul>
                <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : 'enable'; ?>">ACCEUIL</a></li>
                <li><a href="formation.php" class="<?php echo $current_page == 'formation.php' ? 'enable active' : 'enable'; ?>">FORMATION</a></li>
                <li><a href="resources.php" class="<?php echo $current_page == 'resources.php' ? 'enable active' : 'enable'; ?>">RESOURCES</a></li>
                <li><a href="contact.php" class="<?php echo $current_page == 'contact.php' ? 'enable active' : 'enable'; ?>">CONTACT</a></li>
            </ul>
        </nav>

        <a href="login.php" class="login <?php echo $current_page == 'login.php' ? 'active' : ''; ?>">
            <i class="fa-solid fa-right-to-bracket"></i>
            <p>Commencer</p>
        </a>
        <i class="fas fa-bars toggle-menu" id="iconMenu"></i>
        <div class="drop-menu" id="dropMenu">
            <ul>
                <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">ACCEUIL</a></li>
                <li><a href="formation.php" class="<?php echo $current_page == 'formation.php' ? 'enable active' : 'enable'; ?>">FORMATION</a></li>
                <li><a href="resources.php" class="<?php echo $current_page == 'resources.php' ? 'enable active' : 'enable'; ?>">RESOURCES</a></li>
                <li><a href="contact.php" class="<?php echo $current_page == 'contact.php' ? 'enable active' : 'enable'; ?>">CONTACT</a></li>
                <li>
                    <a href="login.php" class="login <?php echo $current_page == 'login.php' ? 'active' : ''; ?>">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <p>Commencer</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>