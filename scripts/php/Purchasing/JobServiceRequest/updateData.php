<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get JSR ID
        $jsrID = '';
        $stmt = $dbOperation->connect()->query("SELECT jsrID FROM jsr WHERE purchasingID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $jsrID .= $result->jsrID;
        }
        //Get Data
        if($dbOperation->updateData('purchasing', array(
            ':dateReceived' => date('Y-m-d', strtotime($_POST['dateReceivedPurchasing'])),
            ':receivedBy' => $_POST['receivedByPurchasing'],
            ':status' => $_POST['statusPurchasing'],
            ':poNo' => $_POST['poNoPurchasing'],
            ':remarks' => (!empty($_POST['remarksPurchasing'])) ? $_POST['remarksPurchasing'] : NULL,
            ':releaseDate' => (!empty($_POST['releaseDatePurchasing'])) ? $_POST['releaseDatePurchasing'] : NULL,
        ), array(
            ':purchasingID' => $_POST['id']
        )) && $dbOperation->updateData('jsr', array(
            ':status' => "(For Purchasing)\n" . "Status: " . $_POST['statusPurchasing']
        ), array(
            ':jsrID' => $jsrID
        ))) {
            echo "Successfully Updated!";
        }
    }