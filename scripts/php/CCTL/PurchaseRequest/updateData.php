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
            ':dateReceived' => date('Y-m-d', strtotime($_POST['dateReceivedCctl'])),
            ':receivedBy' => $_POST['receivedByCctl'],
            ':status' => $_POST['statusCctl'],
            ':remarks' => (!empty($_POST['remarksCctl'])) ? $_POST['remarksCctl'] : NULL,
            ':dateApproved' => date('Y-m-d', strtotime($_POST['dateApprovedCctl']))
        ), array(
            ':cctlID' => $_POST['id']
        )) && $dbOperation->updateData('pr', array(
            ':status' => "(For Cctl)\n" . "Status: " . $_POST['statusCctl']
        ), array(
            ':prID' => $prID
        ))) {
            echo "Successfully Updated!";
        }
    }