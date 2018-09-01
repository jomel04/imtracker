<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get PR ID
        $prID = '';
        $stmt = $dbOperation->connect()->query("SELECT prID FROM pr WHERE budgetID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $prID .= $result->prID;
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
        )) && $dbOperation->updateData('pr', array(
            ':status' => "(For Budget) " . "Budgeted: " . $_POST['budgeted'] . " Status: " . $_POST['statusBudget']
        ), array(
            ':prID' => $prID
        ))) {
            echo "Successfully Updated!";
        }
    }