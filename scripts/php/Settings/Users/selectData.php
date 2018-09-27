<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	//Query
    	$data = array();
        $stmt = $dbOperation->connect()->query("SELECT * FROM users WHERE userID = " . $_POST['id']);
        foreach($stmt->fetchAll() as $row) {
            $data['firstName'] = $row->firstName;
            $data['lastName'] = $row->lastName;
            $data['email'] = $row->email;
            $data['role'] = $row->userType;
            $data['username'] = $row->username;
        }
        $stmt = $dbOperation->connect()->query("SELECT company.companyID FROM company INNER JOIN users ON users.companyID = company.companyID WHERE users.userID = " .  $_POST['id']);
        $data['company'] = $stmt->fetch();

        $stmt = $dbOperation->connect()->query("SELECT department.departmentID FROM department INNER JOIN users ON users.departmentID = department.departmentID WHERE users.userID = " . $_POST['id']);
        $data['department'] = $stmt->fetch();

    	echo json_encode($data);
    }
