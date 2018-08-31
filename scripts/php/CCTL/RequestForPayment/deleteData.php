<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get RFP ID
        $requestForPaymentID = '';
        $stmt = $dbOperation->connect()->query("SELECT rfpID FROM rfp WHERE cctlID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $requestForPaymentID .= $result->rfpID;
        }

    	if($dbOperation->updateData("rfp", array(
            ":state" => 'Inactive'
        ), array(
            ":rfpID" => $requestForPaymentID
        ))) {
            echo 'Data removed!';
        }
    }