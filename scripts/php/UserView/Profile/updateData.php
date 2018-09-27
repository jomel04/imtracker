<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

	//Check for data
    if(isset($_POST['id'])) {
        $result = $dbOperation->updateData('users',
            array(
                ':firstName' => $_POST['firstName'],
                ':lastName' => $_POST['lastName'],
                ':email' => $_POST['email'],
                ':username' => $_POST['username']
            ),
                array(':userID' => $_POST['id'])
        );
        if($result) {
            echo 'Updated Successfully!';
        } else {
            return false;
        }
    }