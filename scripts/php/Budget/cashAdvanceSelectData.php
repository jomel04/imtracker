<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	//Data
        $datas = array();
        
        //BudgetID
    	$budgetData = array(
    		":budgetID" => $_POST['id']
        );
        //Fetch all data
    	foreach($dbOperation->selectRow("budget", $budgetData) as $row) {
    		$datas['budgeted'] = $row->budgeted;
    		$datas['dateReceivedBudget'] = $row->dateReceived;
    		$datas['dateApprovedBudget'] = $row->dateApproved;
    		$datas['receivedByBudget'] = $row->receivedBy;
    		$datas['statusBudget'] = $row->status;
    		$datas['remarksBudget'] = $row->remarks;
    	}
    	echo json_encode($datas);
    }
