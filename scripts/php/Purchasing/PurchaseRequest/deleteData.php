<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get PR ID
        $purchaseRequestID = '';
        $stmt = $dbOperation->connect()->query("SELECT prID FROM pr WHERE purchasingID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $purchaseRequestID .= $result->prID;
        }

    	if($dbOperation->updateData("pr", array(
            ":state" => 'Inactive'
        ), array(
            ":prID" => $purchaseRequestID
        ))) {
            echo 'Data removed!';
        }
    }