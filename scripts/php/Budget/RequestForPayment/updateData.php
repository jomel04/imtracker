<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get RFP ID
        $rfpID = '';
        $stmt = $dbOperation->connect()->query("SELECT rfpID FROM rfp WHERE budgetID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $rfpID .= $result->rfpID;
        }
        //Get Data
        if($dbOperation->updateData('budget', array(
            ':budgeted' => $_POST['budgeted'],
            ':dateReceived' => date('Y-m-d', strtotime($_POST['dateReceivedBudget'])),
            ':dateApproved' => (!empty($_POST['dateApprovedBudget'])) ? date('Y-m-d', strtotime($_POST['dateApprovedBudget'])) : NULL,
            ':receivedBy' => $_POST['receivedByBudget'],
            ':status' => $_POST['statusBudget'],
            ':remarks' => (!empty($_POST['remarksBudget'])) ? $_POST['remarksBudget'] : NULL
        ), array(
            ':budgetID' => $_POST['id']
        )) && $dbOperation->updateData('rfp', array(
            ':status' => "(For Budget)\n" . "Budgeted: " . $_POST['budgeted'] . "\nStatus: " . $_POST['statusBudget']
        ), array(
            ':rfpID' => $rfpID
        ))) {
            echo "Successfully Updated!";
        }
    }