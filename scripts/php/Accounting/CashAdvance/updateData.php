<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get CA ID
        $cashAdvanceID = '';
        $stmt = $dbOperation->connect()->query("SELECT caID FROM ca WHERE acctgID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $cashAdvanceID .= $result->caID;
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
        )) && $dbOperation->updateData('ca', array(
            ':status' => "(For Accounting)\n" . "Status: " . $_POST['statusAccounting'] . "\nOn: " . $_POST['releaseDateAccounting']
        ), array(
            ':caID' => $cashAdvanceID
        ))) {
            echo 'Successfully Updated!';
        }
    }