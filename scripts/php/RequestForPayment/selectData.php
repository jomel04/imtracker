<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	//Data
        $datas = array();
        $stmt = $dbOperation->connect()->query("SELECT rfp.dateCreated, users.userID, rfp.payee, rfp.purpose, rfp.remarks, rfp.cost FROM rfp INNER JOIN users ON rfp.userID = users.userID WHERE rfp.rfpID = " . $_POST['id']);

        foreach($stmt->fetchAll() as $row) {
            $datas['dateCreated'] = $row->dateCreated;
            $datas['requestor'] = $row->userID;
            $datas['payee'] = $row->payee;
            $datas['purpose'] = $row->purpose;
            $datas['remarks'] = $row->remarks;
            $datas['cost'] = $row->cost;
        }

    	//Getting Expense Account type
    	$stmt = $dbOperation->connect()->query("SELECT expense_account.expenseID FROM expense_account INNER JOIN rfp ON rfp.expenseID = expense_account.expenseID WHERE rfp.rfpID = '".$_POST['id']."'");
    	$datas['expenseAccount'] = $stmt->fetch();

    	//Getting Section type
    	$stmt = $dbOperation->connect()->query("SELECT section.sectionID FROM section INNER JOIN rfp ON rfp.sectionID = section.sectionID WHERE rfp.rfpID = '".$_POST['id']."'");
    	$datas['section'] = $stmt->fetch();

    	//Getting manager data
    	$stmt = $dbOperation->connect()->query("SELECT dateReceived, manager.status, dateApproved, manager.remarks FROM manager INNER JOIN rfp ON rfp.managerID = manager.managerID WHERE rfp.rfpID = '".$_POST['id']."'");
    	foreach($stmt->fetchAll() as $row) {
    		$datas['dateReceived'] = $row->dateReceived;
    		$datas['status'] = $row->status;
    		$datas['dateApproved'] = $row->dateApproved;
    		$datas['managerRemarks'] = $row->remarks;
    	}
    	echo json_encode($datas);
    }
