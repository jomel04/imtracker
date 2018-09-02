<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Get PR ID
        $prID = '';
        $stmt = $dbOperation->connect()->query("SELECT prID FROM pr WHERE purchasingID = " . $_POST['id']);
        if($result = $stmt->fetch()) {
            $prID .= $result->prID;
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
        )) && $dbOperation->updateData('pr', array(
            ':status' => "(For Purchasing)\n" . "Status: " . $_POST['statusPurchasing']
        ), array(
            ':prID' => $prID
        ))) {
            echo "Successfully Updated!";
        }
    }