<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();
    //QUERY
    $query = "SELECT budget.budgetID, jsr.refNo, users.lastName, users.firstName, expense_account.type AS ExpenseAccount, section.type AS Section, jsr.purpose, jsr.remarks AS JobServiceRequestRemarks, jsr.cost, jsr.chargeTo, budget.budgeted, budget.dateReceived, budget.receivedBy, budget.status, budget.remarks AS BudgetRemarks, budget.dateApproved, 5 * (DATEDIFF(NOW(), budget.dateReceived) DIV 7) + MID('0123455401234434012332340122123401101234000123450', 7 * WEEKDAY(budget.dateReceived) + WEEKDAY(NOW()) + 1, 1) AS LeadTime FROM jsr INNER JOIN budget ON jsr.budgetID = budget.budgetID INNER JOIN expense_account ON jsr.expenseID = expense_account.expenseID INNER JOIN section ON jsr.sectionID = section.sectionID INNER JOIN lead_time ON budget.leadTimeID = lead_time.leadTimeID INNER JOIN manager ON jsr.managerID = manager.managerID INNER JOIN users ON jsr.userID = users.userID INNER JOIN cctl ON jsr.cctlID = cctl.cctlID WHERE jsr.state = 'Active' AND manager.status = 'Approved' AND cctl.status = 'Approved' AND budget.status != 'Approved' AND budget.status != 'Released'";

    //For Search Bar
    if(!empty($_POST["search"]["value"])) {
        $query .= " AND budget.budgeted LIKE '%".$_POST['search']['value']."%' OR jsr.refNo LIKE '%".$_POST['search']['value']."%' OR users.lastName LIKE '%".$_POST['search']['value']."%' OR users.firstName LIKE '%".$_POST['search']['value']."%' OR expense_account.type LIKE '%".$_POST['search']['value']."%' OR section.type LIKE '%".$_POST['search']['value']."%' OR budget.status LIKE '%".$_POST['search']['value']."%' OR jsr.chargeTo LIKE '%".$_POST['search']['value']."%'";
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
			$stmt = $dbOperation->connect()->prepare("SELECT budget.budgetID, jsr.refNo, users.lastName, users.firstName, expense_account.type AS ExpenseAccount, section.type AS Section, jsr.purpose, jsr.remarks AS JobServiceRequestRemarks, jsr.cost, jsr.chargeTo, budget.budgeted, budget.dateReceived, budget.receivedBy, budget.status, budget.remarks AS BudgetRemarks, budget.dateApproved, 5 * (DATEDIFF(NOW(), budget.dateReceived) DIV 7) + MID('0123455401234434012332340122123401101234000123450', 7 * WEEKDAY(budget.dateReceived) + WEEKDAY(NOW()) + 1, 1) AS LeadTime FROM jsr INNER JOIN budget ON jsr.budgetID = budget.budgetID INNER JOIN expense_account ON jsr.expenseID = expense_account.expenseID INNER JOIN section ON jsr.sectionID = section.sectionID INNER JOIN lead_time ON budget.leadTimeID = lead_time.leadTimeID INNER JOIN manager ON jsr.managerID = manager.managerID INNER JOIN users ON jsr.userID = users.userID INNER JOIN cctl ON jsr.cctlID = cctl.cctlID WHERE jsr.state = 'Active' AND manager.status = 'Approved' AND cctl.status = 'Approved' AND budget.status != 'Approved' AND budget.status != 'Released'");
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
                $subArray[] = '<div class="text-center">' . $row['refNo'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ", " . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['JobServiceRequestRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['chargeTo'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['budgeted'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateReceived'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['receivedBy'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['BudgetRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateApproved'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['LeadTime'] . '</div>';
                $subArray[] = "<div class='btn-group'><button type='button' id='".$row['budgetID']."' name='btnUpdateBudget' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['budgetID']."' name='btnDeleteBudget' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div>";
            } elseif($row['LeadTime'] < '6') {
                $subArray[] = '<div class="text-center">' . $row['budgetID'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['refNo'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ", " . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['JobServiceRequestRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['chargeTo'] . '</div>';
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
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['refNo'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['lastName'] . ", " . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['JobServiceRequestRemarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['chargeTo'] . '</div>';
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