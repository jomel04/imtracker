<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
    	//Query
    	$stmt = $dbOperation->connect()->query("SELECT name FROM department WHERE departmentID = " . $_POST['id']);
    	$data['name'] = $stmt->fetch();
    	echo json_encode($data);
    }
