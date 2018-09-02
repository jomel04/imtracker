<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get RFP ID
        $rfpID = '';
        $stmt = $dbOperation->connect()->query("SELECT rfpID FROM rfp WHERE acctgID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $rfpID .= $result->rfpID;
        }
        //Get Data
        if($dbOperation->updateData('accounting', array(
            ':dateReceived' => date('Y-m-d', strtotime($_POST['dateReceivedAccounting'])),
            ':receivedBy' => $_POST['receivedByAccounting'],
            ':status' => $_POST['statusAccounting'],
            ':releaseDate' => (!empty($_POST['releaseDateAccounting'])) ? $_POST['releaseDateAccounting'] : NULL,
            ':remarks' => (!empty($_POST['remarksAccounting'])) ? $_POST['remarksAccounting'] : NULL
        ), array(
            ':acctgId' => $_POST['id']
        )) && $dbOperation->updateData('rfp', array(
            ':status' => "(For Accounting)\n" . "Status: " . $_POST['statusAccounting'] . "\nOn: " . $_POST['releaseDateAccounting']
        ), array(
            ':rfpID' => $rfpID
        ))) {
            echo 'Successfully Updated!';
        }
    }