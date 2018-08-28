<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	//Data
        $datas = array();
        
        //BudgetID
    	$cctlData = array(
    		":cctlID" => $_POST['id']
        );
        //Fetch all data
    	foreach($dbOperation->selectRow("cctl", $cctlData) as $row) {
			$datas['dateReceivedCctl'] = $row->dateReceived;
			$datas['receivedByCctl'] = $row->receivedBy;
			$datas['statusCctl'] = $row->status;
    		$datas['remarksCctl'] = $row->remarks;
    		$datas['dateApprovedCctl'] = $row->dateApproved;
    	}
    	echo json_encode($datas);
    }
