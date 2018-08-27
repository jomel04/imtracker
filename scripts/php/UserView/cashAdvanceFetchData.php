<?php
    session_start();
    use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();
    
    //QUERY
    $query = "SELECT ca.caID, ca.dateCreated, ca.dateEntered, banana_calendars.week_number, banana_calendars.period_number, ca.status, expense_account.type AS ExpenseAccount, section.type AS Section, users.lastName, users.firstName, ca.purpose, ca.remarks, ca.cost FROM ca INNER JOIN banana_calendars ON ca.calID = banana_calendars.calID INNER JOIN expense_account ON ca.expenseID = expense_account.expenseID INNER JOIN section ON ca.sectionID = section.sectionID INNER JOIN users ON ca.userID = users.userID WHERE users.userID = " . $_SESSION['user'];

    //For Search Bar
    if(!empty($_POST["search"]["value"])) {
        $query .= " AND expense_account.type LIKE '%".$_POST['search']['value']."%' OR ca.status LIKE '%".$_POST['search']['value']."%' OR banana_calendars.week_number LIKE '%".$_POST['search']['value']."%' OR banana_calendars.period_number LIKE '%".$_POST['search']['value']."%'";
    }

    //For Ordering
    if(isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= ' ORDER BY ca.dateCreated ';
    }

    //Limit display
    if($_POST['length'] != -1) {
        $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    //Function for total filtered records
	function fetchAllData() {
		try {
			$stmt = $GLOBALS['dbOperation']->connect()->prepare("SELECT ca.caID, ca.dateCreated, ca.dateEntered, banana_calendars.week_number, banana_calendars.period_number, ca.status, expense_account.type AS ExpenseAccount, section.type AS Section, users.lastName, users.firstName, ca.purpose, ca.remarks, ca.cost FROM ca INNER JOIN banana_calendars ON ca.calID = banana_calendars.calID INNER JOIN expense_account ON ca.expenseID = expense_account.expenseID INNER JOIN section ON ca.sectionID = section.sectionID INNER JOIN users ON ca.userID = users.userID WHERE users.userID = " . $_SESSION['user']);
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
                $subArray[] = '<div class="text-center" style="padding: 0 50px;color:tomato;">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['cost'] . '</div>';
            } elseif(strpos($row['status'], 'Disapproved')) {
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="padding: 0 50px;color:tomato;">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:tomato;">' . $row['cost'] . '</div>';
            } elseif(strpos($row['status'], 'Processing')) {
                $subArray[] = '<div class="text-center">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="padding: 0 50px;">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
            } elseif(strpos($row['status'], 'For Signature')) {
                $subArray[] = '<div class="text-center">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="padding: 0 50px;">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
            } elseif(strpos($row['status'], 'Approved')) {
                $subArray[] = '<div class="text-center">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="padding: 0 50px;">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
            } elseif(strpos($row['status'], 'Released')){
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="padding: 0 50px;color:green;">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color:green;">' . $row['cost'] . '</div>';
            } else {
                $subArray[] = '<div class="text-center">' . $row['dateCreated'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateEntered'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['week_number'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['period_number'] . '</div>';
                $subArray[] = '<div class="text-center" style="padding: 0 50px;">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['remarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
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