<?php
     use System\Classes\Database\DatabaseOperation;
     require "../../../../classes/Autoload.php";
     $dbOperation = new DatabaseOperation();

     if(isset($_POST['id'])) {
        //Get JSR ID
        $jsrID = '';
        $stmt = $dbOperation->connect()->query("SELECT jsrID FROM jsr WHERE cctlID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $jsrID .= $result->jsrID;
        }
        //Get Data
        if($dbOperation->updateData('cctl', array(
            ':status' => 'Approved'
        ), array(
            ':cctlID' => $_POST['id']
        )) && $dbOperation->updateData('jsr', array(
            ':status' => "(For Budget)"
        ), array(
            ':jsrID' => $jsrID
        ))) {
            echo "Successfully Updated!";
        }
    }