<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get JSR ID
        $jobServiceRequestID = '';
        $stmt = $dbOperation->connect()->query("SELECT jsrID FROM jsr WHERE cctlID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $jobServiceRequestID .= $result->jsrID;
        }

    	if($dbOperation->updateData("jsr", array(
            ":state" => 'Inactive'
        ), array(
            ":jsrID" => $jobServiceRequestID
        ))) {
            echo 'Data removed!';
        }
    }