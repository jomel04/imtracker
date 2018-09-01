<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get PR ID
        $prID = '';
        $stmt = $dbOperation->connect()->query("SELECT prID FROM pr WHERE acctgID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $prID .= $result->prID;
        }
        //Get Data
        if($dbOperation->updateData('accounting', array(
            ':dateReceived' => date('Y-m-d', strtotime($_POST['dateReceivedAccounting'])),
            ':receivedBy' => $_POST['receivedByAccounting'],
            ':status' => $_POST['statusAccounting'],
            ':releaseDate' => $_POST['releaseDateAccounting'],
            ':remarks' => $_POST['remarksAccounting']
        ), array(
            ':acctgId' => $_POST['id']
        )) && $dbOperation->updateData('pr', array(
            ':status' => "(For Accounting) " . "Status: " . $_POST['statusAccounting'] . " On: " . $_POST['releaseDateAccounting']
        ), array(
            ':prID' => $prID
        ))) {
            echo 'Successfully Updated!';
        }
    }