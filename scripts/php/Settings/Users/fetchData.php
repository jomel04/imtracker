<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    //QUERY
    $query = "SELECT users.userID, users.lastName, users.firstName, company.name AS Company, department.name AS Department, users.email, users.username FROM users INNER JOIN company ON users.companyID = company.companyID INNER JOIN department ON users.departmentID = department.departmentID";

    //For Search Bar
    if(!empty($_POST["search"]["value"])) {
        $query .= " WHERE users.lastName LIKE '%" . $_POST['search']['value'] . "%' OR users.firstName LIKE '%" . $_POST['search']['value'] . "%' OR company.name LIKE '%" . $_POST['search']['value'] . "%' OR department.name LIKE '%" . $_POST['search']['value'] . "%' OR users.username LIKE '%" . $_POST['search']['value'] . "%'";
    }

    //For Ordering
    if(isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= ' ORDER BY userID';
    }

    //Limit display
    if($_POST['length'] != -1) {
        $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}
	
	//Function for total filtered records
	function fetchAllData() {
		$dbOperation = new DatabaseOperation();
		try {
			$stmt = $dbOperation->connect()->prepare("SELECT users.userID, users.lastName, users.firstName, company.name AS Company, department.name AS Department, users.email, users.username FROM users INNER JOIN company ON users.companyID = company.companyID INNER JOIN department ON users.departmentID = department.departmentID");
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
    		$subArray[] = '<div class="text-center">' . $row['userID'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['lastName'] . ', ' . $row['firstName'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['Company'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['Department'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['email'] . '</div>';
    		$subArray[] = '<div class="text-center">' . $row['username'] . '</div>';
    		$subArray[] = "<div class='text-center'><div class='btn-group'><button type='button' id='".$row['userID']."' name='usersBtnSelect' class='btn btn-outline-info'><span class='oi oi-pencil'></span></button><button type='button' id='".$row['userID']."' name='usersBtnDelete' class='btn btn-outline-danger'><span class='oi oi-trash'></span></button></div></div>";
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