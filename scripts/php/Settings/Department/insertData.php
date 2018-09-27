<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

	//Check for data
	if(isset($_POST['action'])) {
		if($_POST['action'] == "Insert") {
            $result = $dbOperation->insertData('department', array(':name' => $_POST['departmentName']));
            if($result) {
                echo 'Inserted Successfully!';
            } else {
                return false;
            }
		}
		elseif(isset($_POST['action']) == "Update") {
            $result = $dbOperation->updateData('department', array(':name' => $_POST['departmentName']), array(':departmentID' => $_POST['id']));
            if($result) {
                echo 'Updated Successfully!';
            } else {
                return false;
            }
			
		}
	}