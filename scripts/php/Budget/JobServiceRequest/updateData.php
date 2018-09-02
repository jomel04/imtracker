<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get JSR ID
        $jsrID = '';
        $stmt = $dbOperation->connect()->query("SELECT jsrID FROM jsr WHERE budgetID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $jsrID .= $result->jsrID;
        }
        //Get Data
        if($dbOperation->updateData('budget', array(
            ':budgeted' => $_POST['budgeted'],
            ':dateReceived' => date('Y-m-d', strtotime($_POST['dateReceivedBudget'])),
            ':dateApproved' => date('Y-m-d', strtotime($_POST['dateApprovedBudget'])),
            ':receivedBy' => $_POST['receivedByBudget'],
            ':status' => $_POST['statusBudget'],
            ':remarks' => (!empty($_POST['remarksBudget'])) ? $_POST['remarksBudget'] : NULL
        ), array(
            ':budgetID' => $_POST['id']
        )) && $dbOperation->updateData('jsr', array(
            ':status' => "(For Budget)\nBudgeted: " . $_POST['budgeted'] . "\nStatus: " . $_POST['statusBudget']
        ), array(
            ':jsrID' => $jsrID
        ))) {
            echo "Successfully Updated!";
        }
    }