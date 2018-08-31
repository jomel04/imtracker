<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	if($dbOperation->updateData("pr", array(
            ":state" => 'Inactive'
        ), array(
            ":prID" => $_POST['id']
        ))) {
            echo 'Data removed!';
        }
    }