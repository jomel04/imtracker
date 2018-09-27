<?php
session_start();
if(isset($_SESSION['userType']) == 'Admin') {
    $user = $_SESSION['user'];
} else {
    echo "<script>location.assign('../index.php');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NEH | Homepage</title>
    <!-- ICON -->
    <link rel="icon" href="../resources/images/NEH.png">
    <!-- JQUERY -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <!-- BOOTSTRAP CSS-->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- BOOTSTRAP JS -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="../resources/css/style.css">
    <style>
        body,
        html {
            height: 100%;
        }

        h1 {
            font-family: Helvetica, sans-serif;
        }
        .container-fluid {
            background-image: url(../resources/images/background-kitten.jpg);
            background-repeat: no-repeat;
            background-size: 100%;
        }
    </style>
</head>

<body>
    <?php
        $activeMenu = '';
        require '../include/header.php';
        ?>
    <div class="container-fluid h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-sm-12 col-md-5 offset-md-6 text-center">
                <h1 class="text-white">Innovations Management Document Tracking System</h1>
            </div>
        </div>
    </div>
</body>

</html>