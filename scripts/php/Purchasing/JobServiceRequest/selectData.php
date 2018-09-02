<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	//Data
        $datas = array();
        
        //PurchasingID
    	$purchasingData = array(
    		":purchasingID" => $_POST['id']
        );
        //Fetch all data
    	foreach($dbOperation->selectRow("purchasing", $purchasingData) as $row) {
    		$datas['dateReceivedPurchasing'] = $row->dateReceived;
    		$datas['receivedByPurchasing'] = $row->receivedBy;
    		$datas['statusPurchasing'] = $row->status;
    		$datas['poNoPurchasing'] = $row->poNo;
    		$datas['remarksPurchasing'] = $row->remarks;
    		$datas['releaseDatePurchasing'] = $row->releaseDate;
    	}
    	echo json_encode($datas);
    }
