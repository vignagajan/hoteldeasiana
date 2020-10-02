
<link rel="stylesheet" href="../assets/styles/nav.css">

    <div class="l-navbar" id="navbar">
        <nav class="nav">
            <div>
                <div class="nav__brand">
                    <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                    <a href="#" class="nav__logo">Hotel de Asiana</a>
                </div>
                <div class="nav__list">
                    <a href="index.php" class="nav__link <?php echo ($page == "Dashboard" ? "active" : "")?>">
                        <ion-icon name="home-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Dashboard</span>
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
    <script src="../assets/scripts/nav.js"></script>