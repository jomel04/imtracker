<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    //Last Query = SELECT budget.budgetID, ca.requestor, expense_account.type AS ExpenseAccount, section.type AS Section, ca.purpose, ca.remarks AS CashAdvanceRemarks, ca.cost, budget.budgeted, budget.dateReceived, budget.receivedBy, budget.status, budget.remarks AS BudgetRemarks, budget.dateApproved, DATEDIFF(DATE_ADD(budget.dateReceived, INTERVAL lead_time.leadTime + 2 DAY), NOW()) AS LeadTime FROM ca INNER JOIN budget ON ca.budgetID = budget.budgetID INNER JOIN expense_account ON ca.expenseID = expense_account.expenseID INNER JOIN section ON ca.sectionID = section.sectionID INNER JOIN lead_time ON budget.leadTimeID = lead_time.leadTimeID INNER JOIN manager ON ca.managerID = manager.managerID WHERE manager.status = 'Approved' AND budget.status != 'Approved'
    //QUERY
    $query = "SELECT budget.budgetID, ca.requestor, expense_account.type AS ExpenseAccount, section.type AS Section, ca.purpose, ca.remarks AS CashAdvanceRemarks, ca.cost, budget.budgeted, budget.dateReceived, budget.receivedBy, budget.status, budget.remarks AS BudgetRemarks, budget.dateApproved, DATEDIFF(DATE_ADD(budget.dateReceived, INTERVAL lead_time.leadTime - 2 DAY), NOW()) AS LeadTime FROM ca INNER JOIN budget ON ca.budgetID = budget.budgetID INNER JOIN expense_account ON ca.expenseID = expense_account.expenseID INNER JOIN section ON ca.sectionID = section.sectionID INNER JOIN lead_time ON budget.leadTimeID = lead_time.leadTimeID INNER JOIN manager ON ca.managerID = manager.managerID WHERE manager.status = 'Approved' AND budget.status != 'Approved'";

    //For Search Bar
    if(!empty($_POST["search"]["value"])) {
        $query .= " AND ca.requestor LIKE '%".$_POST['search']['value']."%' OR expense_account.type LIKE '%".$_POST['search']['value']."%' OR section.type LIKE '%".$_POST['search']['value']."%' OR ca.cost LIKE '%".$_POST['search']['value']."%' OR budget.budgeted LIKE '%".$_POST['search']['value']."%' OR budget.receivedBy LIKE '%".$_POST['search']['value']."%' OR budget.status LIKE '%".$_POST['search']['value']."%'";
    }

    //For Ordering
    if(isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= ' ORDER BY budget.budgetID ';
    }

    //Limit display
    if($_POST['length'] != -1) {
        $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    //Function for total filtered records
	function fetchAllData() {
		$dbOperation = new DatabaseOperation();
		try {
			$stmt = $dbOperation->connect()->prepare("SELECT budget.budgetID, ca.requestor, expense_account.type AS ExpenseAccount, section.type AS Section, ca.purpose, ca.remarks AS CashAdvanceRemarks, ca.cost, budget.budgeted, budget.dateReceived, budget.receivedBy, budget.status, budget.remarks AS BudgetRemarks, budget.dateApproved, DATEDIFF(DATE_ADD(budget.dateReceived, INTERVAL lead_time.leadTime - 2 DAY), NOW()) AS LeadTime FROM ca INNER JOIN budget ON ca.budgetID = budget.budgetID INNER JOIN expense_account ON ca.expenseID = expense_account.expenseID INNER JOIN section ON ca.sectionID = section.sectionID INNER JOIN lead_time ON budget.leadTimeID = lead_time.leadTimeID INNER JOIN manager ON ca.managerID = manager.managerID WHERE manager.status = 'Approved' AND budget.status != 'Approved'");
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
            if($row['budgeted'] == "") {
                $subArray[] = '<div class="text-center">' . $row['budgetID'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['requestor'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['CashAdvanceRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['budgeted'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateReceived'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['receivedBy'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['BudgetRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateApproved'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['LeadTime'] . '</div>';
                $subArray[] = "<div class='btn-group'><button type='button' id='".$row['budgetID']."' name='btnUpdateBudget' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['budgetID']."' name='btnDeleteBudget' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div>";
            } elseif($row['LeadTime'] > '0') {
                $subArray[] = '<div class="text-center">' . $row['budgetID'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['requestor'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['CashAdvanceRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['budgeted'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateReceived'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['receivedBy'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['BudgetRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateApproved'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['LeadTime'] . '</div>';
                $subArray[] = "<div class='btn-group'><button type='button' id='".$row['budgetID']."' name='btnUpdateBudget' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['budgetID']."' name='btnDeleteBudget' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div>";
            } else {
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['budgetID'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['requestor'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['CashAdvanceRemarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['budgeted'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['dateReceived'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['receivedBy'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['BudgetRemarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['dateApproved'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['LeadTime'] . '</div>';
                $subArray[] = "<div class='btn-group'><button type='button' id='".$row['budgetID']."' name='btnUpdateBudget' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['budgetID']."' name='btnDeleteBudget' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div>";
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