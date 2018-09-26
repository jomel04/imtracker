<?php
    use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

	//Check for data
	if(isset($_POST['action'])) {
		if($_POST['action'] == "Insert") {
            $result = $dbOperation->insertData('company', array(':name' => $_POST['companyName']));
            if($result) {
                echo 'Inserted Successfully!';
            } else {
                return false;
            }
		}
		elseif(isset($_POST['action']) == "Update") {
            $result = $dbOperation->updateData('company', array(':name' => $_POST['companyName']), array(':companyID' => $_POST['id']));
            if($result) {
                echo 'Updated Successfully!';
            } else {
                return false;
            }
			
		}
	}