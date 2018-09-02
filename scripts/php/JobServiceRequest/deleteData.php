<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	if($dbOperation->updateData("jsr", array(
            ":state" => 'Inactive'
        ), array(
            ":jsrID" => $_POST['id']
        ))) {
            echo 'Data removed!';
        }
    }