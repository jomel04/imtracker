<?php
     use System\Classes\Database\DatabaseOperation;
     require "../../../../classes/Autoload.php";
     $dbOperation = new DatabaseOperation();

     if(isset($_POST['id'])) {
        //Get PR ID
        $prID = '';
        $stmt = $dbOperation->connect()->query("SELECT prID FROM pr WHERE cctlID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $prID .= $result->prID;
        }
        //Get Data
        if($dbOperation->updateData('cctl', array(
            ':status' => 'Approved'
        ), array(
            ':cctlID' => $_POST['id']
        )) && $dbOperation->updateData('pr', array(
            ':status' => "(For Budget)"
        ), array(
            ':prID' => $prID
        ))) {
            echo "Successfully Updated!";
        }
    }