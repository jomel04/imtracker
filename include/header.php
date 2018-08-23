<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="home.php"><img src="../resources/images/NEH.png" class="img-fluid" width="60" height="60"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div id="collapsibleNavbar" class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            <?php if(isset($_SESSION['userType']) == 'Admin'): ?>
            <li class="nav-item">
                <?php
                if(isset($activeMenu) == 'ca') {
                    echo "<a class='nav-link active' href='../pages/ca.php'>CA</a>";
                }
                else {
                    echo "<a class='nav-link' href='../pages/ca.php'>CA</a>";
                }
                ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">RFP</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">PR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">JSR</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDrop" data-toggle="dropdown">
                    Settings
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../pages/profile.php">Profile</a>
                    <a class="dropdown-item" href="../scripts/php/Authentication/logout.php">Log Out</a>
                </div>
            </li>
            <?php else: ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDrop" data-toggle="dropdown">
                    Settings
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../pages/profile.php">Profile</a>
                    <a class="dropdown-item" href="../scripts/php/Authentication/logout.php">Log Out</a>
                </div>
            </li>
            <?php endif;?> 
        </ul>
    </div>
</nav>
