<?php
    session_start();
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

	//Check for data
    if(isset($_SESSION['user'])) {
        if ($_POST['newPassword'] != $_POST['confirmPassword']) {
            echo '<script>alert("Password confirmation doesn\'t match!")</script>';
            if($_SESSION['userType'] != 'Admin') {
                echo '<script>location.assign("../../../../pages/userview.php")</script>';
            } else {
                echo '<script>location.assign("../../../../pages/settings.php")</script>';
            }
            return false;
        } 
        //Select specific user from Database
        $query = $dbOperation->selectRow("users", array(":userID" => $_SESSION['user']));
        if(!$query) {
            return false;
        }
        foreach($query as $result) {
            if(password_verify($_POST['currentPassword'], $result->password)) {
                $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                $statement = $dbOperation->updateData('users',
                array(':password' => $password), array(':userID' => $_SESSION['user'])
                );
                if($statement) {
                    echo "<script>alert('Updated Successfully!')</script>";
                    echo "<script>alert('Please login to continue!')</script>";
                    if($_SESSION['userType'] != 'Admin') {
                        echo '<script>location.assign("../../../../scripts/php/Authentication/logout.php")</script>';
                    } else {
                        echo '<script>location.assign("../../../../scripts/php/Authentication/logout.php")</script>';
                    }
                } else {
                    return false;
                }
            } else {
                echo "<script>alert('Old Password doesn\'t match!')</script>";
                if($_SESSION['userType'] != 'Admin') {
                    echo '<script>location.assign("../../../../pages/userview.php")</script>';
                } else {
                    echo '<script>location.assign("../../../../pages/settings.php")</script>';
                }
            }
        }
    }