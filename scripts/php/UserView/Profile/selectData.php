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
            $data['username'] = $row->username;
        }
    	echo json_encode($data);
    }
