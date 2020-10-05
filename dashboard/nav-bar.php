
<?php if ($page == "Dashboard") { ?>
<link rel="stylesheet" href="../assets/styles/nav.css">
<?php } else { ?>
    <link rel="stylesheet" href="../../assets/styles/nav.css">
<?php } ?>
    <div class="l-navbar" id="navbar">
        <nav class="nav">
            <div>
                <div class="nav__brand">
                    <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                    <a href="#" class="nav__logo">Hotel de Asiana</a>
                </div>
                <div class="nav__list">
                    <a href="<?php echo ($page == "Dashboard" ? "index.php" : "../index.php")?>" class="nav__link <?php echo ($page == "Dashboard" ? "active" : "")?>">
                        <ion-icon name="home-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Dashboard</span>
                    </a>
                </div>
                <div class="nav__list">
                    <a href="<?php echo ($page == "Dashboard" ? "customer/index.php" : "index.php")?>" class="nav__link <?php echo ($page == "Customer" ? "active" : "")?>">
                        <ion-icon name="people-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Customer</span>
                    </a>
                </div>
            </div>

            <a href="../logout.php" class="nav__link">
                <ion-icon name="log-out-outline" class="nav__icon"></ion-icon>
                <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>

    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <?php if ($page == "Dashboard") { ?>
    <script src="../assets/scripts/nav.js"></script>
    <?php } else { ?>
    <script src="../../assets/scripts/nav.js"></script>
    <?php } ?>