<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get CA ID
        $cashAdvanceID = '';
        $stmt = $dbOperation->connect()->query("SELECT caID FROM ca WHERE acctgID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $cashAdvanceID .= $result->caID;
        }

    	if($dbOperation->updateData("ca", array(
            ":state" => 'Inactive'
        ), array(
            ":caID" => $cashAdvanceID
        ))) {
            echo 'Data removed!';
        }
    }