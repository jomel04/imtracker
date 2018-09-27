<nav class="navbar navbar-expand-sm navbar-light bg-light">
	<?php if($_SESSION['userType'] == 'Admin'): ?>
    <a class="navbar-brand" href="home.php"><img src="../resources/images/NEH.png" class="img-fluid" width="60" height="60"></a>
	<?php elseif($_SESSION['userType'] == 'User'): ?>
	<a class="navbar-brand" href="userview.php"><img src="../resources/images/NEH.png" class="img-fluid" width="60" height="60"></a>
	<?php endif; ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div id="collapsibleNavbar" class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            <?php if($_SESSION['userType'] == 'Admin'): ?>
            <li class="nav-item">
                <?php if($activeMenu == 'cashAdvance'): ?>
                <a class="nav-link active" href="../pages/ca.php">CA</a>
                <?php else: ?>
                <a class="nav-link" href="../pages/ca.php">CA</a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <?php if($activeMenu == 'requestForPayment'): ?>
                <a class="nav-link active" href="../pages/rfp.php">RFP</a>
                <?php else: ?>
                <a class="nav-link" href="../pages/rfp.php">RFP</a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <?php if($activeMenu == 'purchaseRequest'): ?>
                <a class="nav-link active" href="../pages/pr.php">PR</a>
                <?php else: ?>
                <a class="nav-link" href="../pages/pr.php">PR</a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <?php if($activeMenu == 'jobServiceRequest'): ?>
                <a class="nav-link active" href="../pages/jsr.php">JSR</a>
                <?php else: ?>
                <a class="nav-link" href="../pages/jsr.php">JSR</a>
                <?php endif; ?>
            </li>
            <li class="nav-item dropdown">
                <?php if($activeMenu == 'settings'): ?>
                <a class="nav-link dropdown-toggle active" href="#" id="navbarDrop" data-toggle="dropdown">
                    <?php echo $_SESSION['name'];?>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../pages/settings.php">Settings</a>
                    <a class="dropdown-item" href="../scripts/php/Authentication/logout.php">Log Out</a>
                </div>
                <?php else: ?>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDrop" data-toggle="dropdown">
                    <?php echo $_SESSION['name'];?>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../pages/settings.php">Settings</a>
                    <a class="dropdown-item" href="../scripts/php/Authentication/logout.php">Log Out</a>
                </div>
                <?php endif; ?>
            </li>
        	<?php elseif($_SESSION['userType'] == 'User'): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDrop" data-toggle="dropdown">
                    <?php echo $_SESSION['name'];?>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item btnProfile" id="<?php echo $_SESSION['user'];?>" href="#" data-toggle="modal" data-target="#userProfileModal">Profile</a>
                    <a class="dropdown-item btnChangePass" id="<?php echo $_SESSION['user'];?>" href="#" data-toggle="modal" data-target="#changePassModal">Change Pass</a>
                    <a class="dropdown-item" href="../scripts/php/Authentication/logout.php">Log Out</a>
                </div>
            </li>
            <?php endif; ?> 
        </ul>
    </div>
</nav>
