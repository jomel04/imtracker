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
    <!-- BOOTSTRAP CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- BOOTSTRAP JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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