<?php
    session_start();
    if(isset($_SESSION['userType']) == 'Admin') {
        echo "<script>location.assign('pages/home.php');</script>";
    } elseif(isset($_SESSION['userType']) == 'user') {
        echo "<script>location.assign('pages/userview.php');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NEH | User Login</title>
    <!-- ICON -->
    <link rel="icon" href="resources/images/NEH.png">
    <!-- JQUERY -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <!-- BOOTSTRAP CSS-->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- BOOTSTRAP JS -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="resources/css/index.css">
</head>

<body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-sm-12 col-md-5 text-center">
                <img src="resources/images/NEH.png" class="img-fluid" alt="LOGO">
            </div>
            <div class="login-form col-sm-12 col-md-1">
            </div>
            <div class="col-sm-12 col-md-6 text-center">
                <div class="row">
                    <div class="col-sm-12 col-md-12 text-center">
                        <h1 class="text-primary">SIGN IN</h1>
                    </div>
                </div>
                <form method="post" action="scripts/php/Authentication/login.php">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" tabindex="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" tabindex="2" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <a href="#" class="text-primary">Forgot password?</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <button type="submit" name="btnLogin" class="btn btn-outline-primary btn-block btn-md">LOGIN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>