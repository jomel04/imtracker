<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get CA ID
        $rfpID = '';
        $stmt = $dbOperation->connect()->query("SELECT rfpID FROM rfp WHERE cctlID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $rfpID .= $result->rfpID;
        }
        //Get Data
        if($dbOperation->updateData('cctl', array(
            ':dateReceived' => date('Y-m-d', strtotime($_POST['dateReceivedCctl'])),
            ':receivedBy' => $_POST['receivedByCctl'],
            ':status' => $_POST['statusCctl'],
            ':remarks' => $_POST['remarksCctl'],
            ':dateApproved' => date('Y-m-d', strtotime($_POST['dateApprovedCctl']))
        ), array(
            ':cctlID' => $_POST['id']
        )) && $dbOperation->updateData('rfp', array(
            ':status' => "(For Cctl) " . " Status: " . $_POST['statusCctl']
        ), array(
            ':rfpID' => $rfpID
        ))) {
            echo "Successfully Updated!";
        }
    }