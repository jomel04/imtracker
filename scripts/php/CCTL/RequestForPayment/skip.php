<?php
     use System\Classes\Database\DatabaseOperation;
     require "../../../../classes/Autoload.php";
     $dbOperation = new DatabaseOperation();

     if(isset($_POST['id'])) {
        //Get RFP ID
        $rfpID = '';
        $stmt = $dbOperation->connect()->query("SELECT rfpID FROM rfp WHERE cctlID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $rfpID .= $result->rfpID;
        }
        //Get Data
        if($dbOperation->updateData('cctl', array(
            ':status' => 'Approved'
        ), array(
            ':cctlID' => $_POST['id']
        )) && $dbOperation->updateData('rfp', array(
            ':status' => "(For Budget)"
        ), array(
            ':rfpID' => $rfpID
        ))) {
            echo "Successfully Updated!";
        }
    }