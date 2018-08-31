<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    //QUERY
    $query = "SELECT pr.prID, pr.dateCreated, pr.dateEntered, banana_calendars.week_number, banana_calendars.period_number, pr.refNo, expense_account.type AS ExpenseAccount, section.type AS Section, users.lastName, users.firstName, pr.purpose, pr.remarks AS PurchaseRequestRemarks, pr.cost, pr.chargeTo, manager.dateReceived, manager.status AS Status, manager.dateApproved AS DateApproved,manager.remarks AS ManagerRemarks , DATEDIFF(manager.dateApproved, manager.dateReceived) AS NoOfDays FROM pr INNER JOIN manager ON pr.managerID = manager.managerID INNER JOIN banana_calendars ON pr.calID = banana_calendars.calID INNER JOIN expense_account ON pr.expenseID = expense_account.expenseID INNER JOIN section ON pr.sectionID = section.sectionID INNER JOIN users ON pr.userID = users.userID WHERE pr.state = 'Active' AND manager.status != 'Approved'";

    //For Search Bar
    if(!empty($_POST["search"]["value"])) {
        $query .= " AND pr.refNo LIKE '%".$_POST['search']['value']."%' OR users.lastName LIKE '%".$_POST['search']['value']."%' OR users.firstName LIKE '%".$_POST['search']['value']."%'  OR pr.chargeTo LIKE '%".$_POST['search']['value']."%' OR expense_account.type LIKE '%".$_POST['search']['value']."%' OR section.type LIKE '%".$_POST['search']['value']."%' OR banana_calendars.week_number LIKE '%".$_POST['search']['value']."%' OR banana_calendars.period_number LIKE '%".$_POST['search']['value']."%' OR manager.status LIKE '%".$_POST['search']['value']."%'";
    }

    //For Ordering
    if(isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= ' ORDER BY pr.prID ';
    }

    //Limit display
    if($_POST['length'] != -1) {
        $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}
	
	//Function for total filtered records
	function fetchAllData() {
		$dbOperation = new DatabaseOperation();
		try {
			$stmt = $dbOperation->connect()->prepare("SELECT pr.prID, pr.dateCreated, pr.dateEntered, banana_calendars.week_number, banana_calendars.period_number, pr.refNo, expense_account.type AS ExpenseAccount, section.type AS Section, users.lastName, users.firstName, pr.purpose, pr.remarks AS PurchaseRequestRemarks, pr.cost, pr.chargeTo, manager.dateReceived, manager.status AS Status, manager.dateApproved AS DateApproved,manager.remarks AS ManagerRemarks , DATEDIFF(manager.dateApproved, manager.dateReceived) AS NoOfDays FROM pr INNER JOIN manager ON pr.managerID = manager.managerID INNER JOIN banana_calendars ON pr.calID = banana_calendars.calID INNER JOIN expense_account ON pr.expenseID = expense_account.expenseID INNER JOIN section ON pr.sectionID = section.sectionID INNER JOIN users ON pr.userID = users.userID WHERE pr.state = 'Active' AND manager.status != 'Approved'");
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
    		$subArray[] = '<div class="text-center">' . $row['prID'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['dateCreated'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['dateEntered'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['week_number'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['period_number'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['refNo'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['lastName'] . ", " . $row['firstName'] .  '</div>';
    		$subArray[] = $row['purpose'];
    		$subArray[] = $row['PurchaseRequestRemarks'];
    		$subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['chargeTo'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['dateReceived'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['Status'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['DateApproved'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['ManagerRemarks'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['NoOfDays'] . '</div>';
    		$subArray[] = "<div class='btn-group'><button type='button' id='".$row['prID']."' name='btnUpdate' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['prID']."' name='btnDelete' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div>";
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