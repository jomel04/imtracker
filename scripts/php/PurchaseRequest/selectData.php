<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	//Data
        $datas = array();
        $stmt = $dbOperation->connect()->query("SELECT pr.dateCreated, pr.refNo, users.userID, pr.purpose, pr.remarks, pr.cost, pr.chargeTo FROM pr INNER JOIN users ON pr.userID = users.userID WHERE pr.prID = " . $_POST['id']);

        foreach($stmt->fetchAll() as $row) {
            $datas['dateCreated'] = $row->dateCreated;
            $datas['refNo'] = $row->refNo;
            $datas['requestor'] = $row->userID;
            $datas['purpose'] = $row->purpose;
            $datas['remarks'] = $row->remarks;
            $datas['cost'] = $row->cost;
            $datas['chargeTo'] = $row->chargeTo;
        }

    	//Getting Expense Account type
    	$stmt = $dbOperation->connect()->query("SELECT expense_account.expenseID FROM expense_account INNER JOIN pr ON pr.expenseID = expense_account.expenseID WHERE pr.prID = '".$_POST['id']."'");
    	$datas['expenseAccount'] = $stmt->fetch();

    	//Getting Section type
    	$stmt = $dbOperation->connect()->query("SELECT section.sectionID FROM section INNER JOIN pr ON pr.sectionID = section.sectionID WHERE pr.prID = '".$_POST['id']."'");
    	$datas['section'] = $stmt->fetch();

    	//Getting manager data
    	$stmt = $dbOperation->connect()->query("SELECT dateReceived, manager.status, dateApproved, manager.remarks FROM manager INNER JOIN pr ON pr.managerID = manager.managerID WHERE pr.prID = '".$_POST['id']."'");
    	foreach($stmt->fetchAll() as $row) {
    		$datas['dateReceived'] = $row->dateReceived;
    		$datas['status'] = $row->status;
    		$datas['dateApproved'] = $row->dateApproved;
    		$datas['managerRemarks'] = $row->remarks;
    	}
    	echo json_encode($datas);
    }
