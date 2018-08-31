<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get CA ID
        $rfpID = '';
        $stmt = $dbOperation->connect()->query("SELECT rfpID FROM rfp WHERE budgetID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $rfpID .= $result->rfpID;
        }
        //Get Data
        if($dbOperation->updateData('budget', array(
            ':budgeted' => $_POST['budgeted'],
            ':dateReceived' => date('Y-m-d', strtotime($_POST['dateReceivedBudget'])),
            ':dateApproved' => date('Y-m-d', strtotime($_POST['dateApprovedBudget'])),
            ':receivedBy' => $_POST['receivedByBudget'],
            ':status' => $_POST['statusBudget'],
            ':remarks' => $_POST['remarksBudget']
        ), array(
            ':budgetID' => $_POST['id']
        )) && $dbOperation->updateData('rfp', array(
            ':status' => "(For Budget) " . "Budgeted: " . $_POST['budgeted'] . " Status: " . $_POST['statusBudget']
        ), array(
            ':rfpID' => $rfpID
        ))) {
            echo "Successfully Updated!";
        }
    }