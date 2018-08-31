<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	if($dbOperation->updateData("ca", array(
            ":state" => 'Inactive'
        ), array(
            ":caID" => $_POST['id']
        ))) {
            echo 'Data removed!';
        }
    }