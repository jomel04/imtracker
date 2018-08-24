<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();
    //QUERY
    $query = "SELECT accounting.acctgID, users.lastName, users.firstName, expense_account.type AS ExpenseAccount, section.type AS Section, ca.purpose, ca.remarks AS CashAdvanceRemarks, ca.cost, accounting.dateReceived, accounting.receivedBy, accounting.status, accounting.remarks AS AccountingRemarks, accounting.releaseDate, DATEDIFF(NOW(), DATE_ADD(accounting.dateReceived, INTERVAL (lead_time.leadTime / 7) * 2 DAY)) AS LeadTime FROM accounting INNER JOIN ca ON ca.acctgID = accounting.acctgID INNER JOIN expense_account ON ca.expenseID = expense_account.expenseID INNER JOIN section ON ca.sectionID = section.sectionID INNER JOIN manager ON ca.managerID = manager.managerID INNER JOIN budget ON ca.budgetID = budget.budgetID INNER JOIN lead_time ON lead_time.leadTimeID = accounting.leadTimeID INNER JOIN users ON ca.userID = users.userID WHERE manager.status = 'Approved' AND budget.status = 'Approved' AND accounting.status != 'Released'";

    //For Search Bar
    if(!empty($_POST["search"]["value"])) {
        $query .= " AND users.lastName LIKE '%".$_POST['search']['value']."%' OR users.firstName LIKE '%".$_POST['search']['value']."%' OR expense_account.type LIKE '%".$_POST['search']['value']."%' OR section.type LIKE '%".$_POST['search']['value']."%' OR ca.cost LIKE '%".$_POST['search']['value']."%' OR accounting.receivedBy LIKE '%".$_POST['search']['value']."%' OR accounting.status LIKE '%".$_POST['search']['value']."%'";
    }

    // For Ordering
    if(isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= ' ORDER BY accounting.acctgID ';
    }

    // Limit display
    if($_POST['length'] != -1) {
        $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    //Function for total filtered records
	function fetchAllData() {
		$dbOperation = new DatabaseOperation();
		try {
			$stmt = $dbOperation->connect()->prepare("SELECT accounting.acctgID, users.lastName, users.firstName, expense_account.type AS ExpenseAccount, section.type AS Section, ca.purpose, ca.remarks AS CashAdvanceRemarks, ca.cost, accounting.dateReceived, accounting.receivedBy, accounting.status, accounting.remarks AS AccountingRemarks, accounting.releaseDate, DATEDIFF(NOW(), DATE_ADD(accounting.dateReceived, INTERVAL (lead_time.leadTime / 7) * 2 DAY)) AS LeadTime FROM accounting INNER JOIN ca ON ca.acctgID = accounting.acctgID INNER JOIN expense_account ON ca.expenseID = expense_account.expenseID INNER JOIN section ON ca.sectionID = section.sectionID INNER JOIN manager ON ca.managerID = manager.managerID INNER JOIN budget ON ca.budgetID = budget.budgetID INNER JOIN lead_time ON lead_time.leadTimeID = accounting.leadTimeID INNER JOIN users ON ca.userID = users.userID WHERE manager.status = 'Approved' AND budget.status = 'Approved' AND accounting.status != 'Released'");
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
            if($row['status'] == "") {
                $subArray[] = '<div class="text-center">' . $row['acctgID'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ", " . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['CashAdvanceRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateReceived'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['receivedBy'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['AccountingRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['releaseDate'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['LeadTime'] . '</div>';
                $subArray[] = "<div class='btn-group'><button type='button' id='".$row['acctgID']."' name='btnUpdateAccounting' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['acctgID']."' name='btnDeleteAccounting' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div>";
            } elseif($row['LeadTime'] < '5') {
                $subArray[] = '<div class="text-center">' . $row['acctgID'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ", " . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['CashAdvanceRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateReceived'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['receivedBy'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['AccountingRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['releaseDate'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['LeadTime'] . '</div>';
                $subArray[] = "<div class='btn-group'><button type='button' id='".$row['acctgID']."' name='btnUpdateAccounting' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['acctgID']."' name='btnDeleteAccounting' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div>";
            } else {
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['acctgID'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['lastName'] . ", " . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['CashAdvanceRemarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['dateReceived'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['receivedBy'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['AccountingRemarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['releaseDate'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['LeadTime'] . '</div>';
                $subArray[] = "<div class='btn-group'><button type='button' id='".$row['acctgID']."' name='btnUpdateAccounting' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['acctgID']."' name='btnDeleteAccounting' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div>";
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