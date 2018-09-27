<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

	//Check for data
	if(isset($_POST['action'])) {
		if($_POST['action'] == "Insert") {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $result = $dbOperation->insertData('users',
             array(
                 ':companyID' => $_POST['company'],
                 ':departmentID' => $_POST['department'],
                 ':firstName' => $_POST['firstName'],
                 ':lastName' => $_POST['lastName'],
                 ':email' => $_POST['email'],
                 ':username' => $_POST['username'],
                 ':password' => $password,
                 ':userType' => $_POST['role']
            ));
            if($result) {
                echo 'Inserted Successfully!';
            } else {
                return false;
            }
		}
		elseif(isset($_POST['action']) == "Update") {
            $result = $dbOperation->updateData('users',
             array(
                 ':companyID' => $_POST['company'],
                 ':departmentID' => $_POST['department'],
                 ':firstName' => $_POST['firstName'],
                 ':lastName' => $_POST['lastName'],
                 ':email' => $_POST['email'],
                 ':userType' => $_POST['role']
                ),
                  array(':userID' => $_POST['id'])
            );
            if($result) {
                echo 'Updated Successfully!';
            } else {
                return false;
            }
		}
	}