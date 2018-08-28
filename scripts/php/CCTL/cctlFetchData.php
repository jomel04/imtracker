<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();
    //QUERY
    $query = "SELECT cctl.cctlID, users.lastName, users.firstName, expense_account.type AS ExpenseAccount, section.type AS Section, rfp.purpose, rfp.remarks AS RequestForPaymentRemarks, rfp.cost, cctl.dateReceived, cctl.receivedBy, cctl.status, cctl.remarks AS CctlRemarks, cctl.dateApproved, 5 * (DATEDIFF(NOW(), cctl.dateReceived) DIV 7) + MID('0123455401234434012332340122123401101234000123450', 7 * WEEKDAY(cctl.dateReceived) + WEEKDAY(NOW()) + 1, 1) AS LeadTime FROM rfp INNER JOIN cctl ON rfp.cctlID = cctl.cctlID INNER JOIN expense_account ON rfp.expenseID = expense_account.expenseID INNER JOIN section ON rfp.sectionID = section.sectionID INNER JOIN lead_time ON cctl.leadTimeID = lead_time.leadTimeID INNER JOIN manager ON rfp.managerID = manager.managerID INNER JOIN users ON rfp.userID = users.userID WHERE manager.status = 'Approved' AND cctl.status != 'Approved'";

    //For Search Bar
    if(!empty($_POST["search"]["value"])) {
        $query .= " AND users.lastName LIKE '%".$_POST['search']['value']."%' OR users.firstName LIKE '%".$_POST['search']['value']."%' OR expense_account.type LIKE '%".$_POST['search']['value']."%' OR section.type LIKE '%".$_POST['search']['value']."%' OR rfp.cost LIKE '%".$_POST['search']['value']."%' OR cctl.receivedBy LIKE '%".$_POST['search']['value']."%' OR cctl.status LIKE '%".$_POST['search']['value']."%'";
    }

    //For Ordering
    if(isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= ' ORDER BY cctl.cctlID ';
    }

    //Limit display
    if($_POST['length'] != -1) {
        $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    //Function for total filtered records
	function fetchAllData() {
		$dbOperation = new DatabaseOperation();
		try {
			$stmt = $dbOperation->connect()->prepare("SELECT cctl.cctlID, users.lastName, users.firstName, expense_account.type AS ExpenseAccount, section.type AS Section, rfp.purpose, rfp.remarks AS RequestForPaymentRemarks, rfp.cost, cctl.dateReceived, cctl.receivedBy, cctl.status, cctl.remarks AS CctlRemarks, cctl.dateApproved, 5 * (DATEDIFF(NOW(), cctl.dateReceived) DIV 7) + MID('0123455401234434012332340122123401101234000123450', 7 * WEEKDAY(cctl.dateReceived) + WEEKDAY(NOW()) + 1, 1) AS LeadTime FROM rfp INNER JOIN cctl ON rfp.cctlID = cctl.cctlID INNER JOIN expense_account ON rfp.expenseID = expense_account.expenseID INNER JOIN section ON rfp.sectionID = section.sectionID INNER JOIN lead_time ON cctl.leadTimeID = lead_time.leadTimeID INNER JOIN manager ON rfp.managerID = manager.managerID INNER JOIN users ON rfp.userID = users.userID WHERE manager.status = 'Approved' AND cctl.status != 'Approved'");
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
                $subArray[] = '<div class="text-center">' . $row['cctlID'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ", " . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['RequestForPaymentRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateReceived'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['receivedBy'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['CctlRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateApproved'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['LeadTime'] . '</div>';
                $subArray[] = "<div class='btn-group'><button type='button' id='".$row['cctlID']."' name='btnUpdateCctl' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['cctlID']."' name='btnDeleteCctl' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div>";
            } elseif($row['LeadTime'] < '6') {
                $subArray[] = '<div class="text-center">' . $row['cctlID'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['lastName'] . ", " . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['RequestForPaymentRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateReceived'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['receivedBy'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['CctlRemarks'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['dateApproved'] . '</div>';
                $subArray[] = '<div class="text-center">' . $row['LeadTime'] . '</div>';
                $subArray[] = "<div class='btn-group'><button type='button' id='".$row['cctlID']."' name='btnUpdateCctl' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['cctlID']."' name='btnDeleteCctl' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div>";
            } else {
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['cctlID'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['lastName'] . ", " . $row['firstName'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['ExpenseAccount'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['Section'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['purpose'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['RequestForPaymentRemarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['cost'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['dateReceived'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['receivedBy'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['status'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['CctlRemarks'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['dateApproved'] . '</div>';
                $subArray[] = '<div class="text-center" style="color: #EB465A;">' . $row['LeadTime'] . '</div>';
                $subArray[] = "<div class='btn-group'><button type='button' id='".$row['cctlID']."' name='btnUpdateCctl' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['cctlID']."' name='btnDeleteCctl' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div>";
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