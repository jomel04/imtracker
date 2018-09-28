<?php
    session_start();
    use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST["btnLogin"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        //User Login
        $query = $dbOperation->selectRow("users", array(":username" => $username));
        if(!$query) {
            echo "<script>location.assign('../../../index.php');
            alert('Account doesn\'t exist');</script>";
            return false;
        }
        foreach($query as $result) {
            if(password_verify($password, $result->password)) {
                $_SESSION['user'] = $result->userID;
                $_SESSION['name'] = $result->firstName;
                $_SESSION['userType'] = $result->userType;
                if($_SESSION['userType'] == 'Admin') {
                    echo "<script>location.assign('../../../pages/home.php');</script>";
                } else {
                    echo "<script>location.assign('../../../pages/userview.php');</script>";
                }
            } else {
                echo "<script>location.assign('../../../index.php');
                alert('Username and password doesn\'t match');</script>";
            }
        }
    }