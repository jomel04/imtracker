<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	//Data
        $datas = array();
        $stmt = $dbOperation->connect()->query("SELECT ca.dateCreated, users.userID, ca.purpose, ca.remarks, ca.cost FROM ca INNER JOIN users ON ca.userID = users.userID WHERE ca.caID = " . $_POST['id']);

        foreach($stmt->fetchAll() as $row) {
            $datas['dateCreated'] = $row->dateCreated;
            $datas['requestor'] = $row->userID;
            $datas['purpose'] = $row->purpose;
            $datas['remarks'] = $row->remarks;
            $datas['cost'] = $row->cost;
        }

    	//Getting Expense Account type
    	$stmt = $dbOperation->connect()->query("SELECT expense_account.expenseID FROM expense_account INNER JOIN ca ON ca.expenseID = expense_account.expenseID WHERE ca.caID = '".$_POST['id']."'");
    	$datas['expenseAccount'] = $stmt->fetch();

    	//Getting Section type
    	$stmt = $dbOperation->connect()->query("SELECT section.sectionID FROM section INNER JOIN ca ON ca.sectionID = section.sectionID WHERE ca.caID = '".$_POST['id']."'");
    	$datas['section'] = $stmt->fetch();

    	//Getting manager data
    	$stmt = $dbOperation->connect()->query("SELECT dateReceived, manager.status, dateApproved, manager.remarks FROM manager INNER JOIN ca ON ca.managerID = manager.managerID WHERE ca.caID = '".$_POST['id']."'");
    	foreach($stmt->fetchAll() as $row) {
    		$datas['dateReceived'] = $row->dateReceived;
    		$datas['status'] = $row->status;
    		$datas['dateApproved'] = $row->dateApproved;
    		$datas['managerRemarks'] = $row->remarks;
    	}
    	echo json_encode($datas);
    }
