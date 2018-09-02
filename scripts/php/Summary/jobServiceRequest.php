<?php
    session_start();
    use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();
    
    //QUERY
    $query = "SELECT jsr.jsrID, jsr.dateCreated, jsr.dateEntered, banana_calendars.week_number, banana_calendars.period_number, jsr.refNo, jsr.status, expense_account.type AS ExpenseAccount, section.type AS Section, users.lastName, users.firstName, jsr.purpose, jsr.remarks, jsr.cost, jsr.chargeTo FROM jsr INNER JOIN banana_calendars ON jsr.calID = banana_calendars.calID INNER JOIN expense_account ON jsr.expenseID = expense_account.expenseID INNER JOIN section ON jsr.sectionID = section.sectionID INNER JOIN users ON jsr.userID = users.userID WHERE jsr.state = 'Active'";

    //For Search Bar
    if(!empty($_POST["search"]["value"])) {
        $query .= " AND expense_account.type LIKE '%".$_POST['search']['value']."%' OR jsr.refNo LIKE '%".$_POST['search']['value']."%' OR jsr.status LIKE '%".$_POST['search']['value']."%' OR banana_calendars.week_number LIKE '%".$_POST['search']['value']."%' OR banana_calendars.period_number LIKE '%".$_POST['search']['value']."%' OR users.lastName LIKE '%".$_POST['search']['value']."%' OR users.firstName LIKE '%".$_POST['search']['value']."%' OR jsr.chargeTo LIKE '%".$_POST['search']['value']."%'";
    }

    //For Ordering
    if(isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= ' ORDER BY jsr.dateCreated ';
    }

    //Limit display
    if($_POST['length'] != -1) {
        $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    //Function for total filtered records
	function fetchAllData() {
		try {
			$stmt = $GLOBALS['dbOperation']->connect()->prepare("SELECT jsr.jsrID, jsr.dateCreated, jsr.dateEntered, banana_calendars.week_number, banana_calendars.period_number, jsr.refNo, jsr.status, expense_account.type AS ExpenseAccount, section.type AS Section, users.lastName, users.firstName, jsr.purpose, jsr.remarks, jsr.cost, jsr.chargeTo FROM jsr INNER JOIN banana_calendars ON jsr.calID = banana_calendars.calID INNER JOIN expense_account ON jsr.expenseID = expense_account.expenseID INNER JOIN section ON jsr.sectionID = section.sectionID INNER JOIN users ON jsr.userID = users.userID WHERE jsr.state = 'Active'");
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
    
    try {
    	$stmt = $dbOperation->connect()->prepare($query);
    	$stmt->execute();
    	$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    	$data = array();
    	$filteredRows = $stmt->rowCount();
    	foreach($result as $row) {
            $subArray = array();
            if(strpos($row['status'], 'Cancelled')) {
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['refNo'] . '</div>';
                $subArray[] = "<pre style='color:tomato;text-align:center;'>" . $row['status'] . "</pre>";
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['chargeTo'] . '</div>';
            } elseif(strpos($row['status'], 'Disapproved')) {
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['refNo'] . '</div>';
                $subArray[] = "<pre style='color:tomato;text-align:center;'>" . $row['status'] . "</pre>";
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['chargeTo'] . '</div>';
            } elseif(strpos($row['status'], 'Processing')) {
                $subArray[] = '<div class="text-center">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['refNo'] . '</div>';
                $subArray[] = "<pre style='text-align:center;'>" . $row['status'] . "</pre>";
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['chargeTo'] . '</div>';
            } elseif(strpos($row['status'], 'For Signature')) {
                $subArray[] = '<div class="text-center">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['refNo'] . '</div>';
                $subArray[] = "<pre style='text-align:center;'>" . $row['status'] . "</pre>";
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['chargeTo'] . '</div>';
            } elseif(strpos($row['status'], 'Approved')) {
                $subArray[] = '<div class="text-center">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['refNo'] . '</div>';
                $subArray[] = "<pre style='text-align:center;'>" . $row['status'] . "</pre>";
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['chargeTo'] . '</div>';
            } elseif(strpos($row['status'], 'Released')){
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['refNo'] . '</div>';
                $subArray[] = "<pre style='color:green;text-align:center;'>" . $row['status'] . "</pre>";
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['chargeTo'] . '</div>';
            } else {
                $subArray[] = '<div class="text-center">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['refNo'] . '</div>';
                $subArray[] = "<pre style='text-align:center;'>" . $row['status'] . "</pre>";
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['chargeTo'] . '</div>';
            }
            $data[] = $subArray;
    	}
		$output = array(
			"draw" => intval($_POST['draw']),
			"recordsTotal" => $filteredRows,
			"recordsFiltered" => fetchAllData(),
			"data" => $data
		);
		echo json_encode($output);
	} catch(\PDOException $e) {
    	echo $e->getMessage();
    }