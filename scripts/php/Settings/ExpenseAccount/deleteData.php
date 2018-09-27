<?php
	use System\Classes\Database\DatabaseOperation;
    require "../../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

    if(isset($_POST['id'])) {
        //Deleting data
        $result = $dbOperation->deleteData('expense_account', array(':expenseID' => $_POST['id']));
        if(!$result) {
            return false;
        } else {
            echo 'Deleted Successfully!';
        }
    }