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
            ':dateReceived' => date('Y-m-d', strtotime($_POST['dateReceivedCctl'])),
            ':receivedBy' => $_POST['receivedByCctl'],
            ':status' => $_POST['statusCctl'],
            ':remarks' => (!empty($_POST['remarksCctl'])) ? $_POST['remarksCctl'] : NULL,
            ':dateApproved' => (!empty($_POST['dateApprovedCctl'])) ? date('Y-m-d', strtotime($_POST['dateApprovedCctl'])) : NULL
        ), array(
            ':cctlID' => $_POST['id']
        )) && $dbOperation->updateData('jsr', array(
            ':status' => "(For Cctl)\n" . "Status: " . $_POST['statusCctl']
        ), array(
            ':jsrID' => $jsrID
        ))) {
            echo "Successfully Updated!";
        }
    }