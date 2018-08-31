<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	if($dbOperation->updateData("rfp", array(
            ":state" => 'Inactive'
        ), array(
            ":rfpID" => $_POST['id']
        ))) {
            echo 'Data removed!';
        }
    }