<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	//Data
        $datas = array();
        
        //BudgetID
    	$accountingData = array(
    		":acctgID" => $_POST['id']
        );
        //Fetch all data
    	foreach($dbOperation->selectRow("accounting", $accountingData) as $row) {
    		$datas['dateReceivedAccounting'] = $row->dateReceived;
    		$datas['receivedByAccounting'] = $row->receivedBy;
    		$datas['statusAccounting'] = $row->status;
    		$datas['remarksAccounting'] = $row->remarks;
    		$datas['releaseDateAccounting'] = $row->releaseDate;
    	}
    	echo json_encode($datas);
    }
