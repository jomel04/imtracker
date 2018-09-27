<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    //QUERY
    $query = "SELECT * FROM expense_account";

    //For Search Bar
    if(!empty($_POST["search"]["value"])) {
        $query .= " WHERE type LIKE '%" . $_POST['search']['value'] . "%'";
    }

    //For Ordering
    if(isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= ' ORDER BY expenseID';
    }

    //Limit display
    if($_POST['length'] != -1) {
        $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}
	
	//Function for total filtered records
	function fetchAllData() {
		$dbOperation = new DatabaseOperation();
		try {
			$stmt = $dbOperation->connect()->prepare("SELECT * FROM expense_account");
			$stmt->execute();
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			if(!$result) {
				return false;
			}
			return $stmt->rowCount();
		} catch(\PDOException $e) {
			echo $e->getMessage();
		}
	}
	//Display All Data!
    try {
    	$stmt = $dbOperation->connect()->prepare($query);
    	$stmt->execute();
    	$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    	$data = array();
    	$filteredRows = $stmt->rowCount();
    	foreach($result as $row) {
    		$subArray = array();
    		$subArray[] = '<div class="text-center">' . $row['expenseID'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['type'] . '</div>';
    		$subArray[] = "<div class='text-center'><div class='btn-group'><button type='button' id='".$row['expenseID']."' name='expenseAccountBtnSelect' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['expenseID']."' name='expenseAccountBtnDelete' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div></div>";
    		$data[] = $subArray;
    	}
		$output = array(
			"draw" => intval($_POST['draw']),
			"recordsTotal" => $filteredRows,
			"recordsFiltered" => fetchAllData(),
			"data" => $data
		);
		//Encode to json
		echo json_encode($output);
	} catch(\PDOException $e) {
    	echo $e->getMessage();
    }