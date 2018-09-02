<?php
	session_start();
    use System\Classes\Database\DatabaseOperation;
    require "../../../classes/Autoload.php";
    $dbOperation = new DatabaseOperation();

	//Check for data
	if(isset($_POST['action'])) {
		if($_POST['action'] == "Insert") {

			//Getting ID of Banana Calendar ID (current time)
			/* -------------------------------------------------- */
			date_default_timezone_set('Asia/Manila');
			$date = date("Y-m-d");
			$queryWeekNo = $dbOperation->connect()->query("SELECT calID FROM banana_calendars WHERE date_from <= '$date' AND date_to >= '$date'");
			$getWeekNumber = "";
			if($resultQueryWeekNo = $queryWeekNo->fetch()) {
				$getWeekNumber .= $resultQueryWeekNo->calID;
			}
			/* -------------------------------------------------- */

			//For Manager Table
			/* -------------------------------------------------- */
			$managerData = array(
				":dateReceived" => (!empty($_POST['dateReceived'])) ? $_POST['dateReceived'] : NULL,
				":status" => $_POST['status'],
				":dateApproved" => (!empty($_POST['dateApproved'])) ? $_POST['dateApproved'] : NULL,
				":remarks" => (!empty($_POST['managerRemarks'])) ? $_POST['managerRemarks'] : NULL
			);
			//Inserting Data and get last ID
			$managerInsertId = $dbOperation->insertDataGetLastId("manager", $managerData);

			//For Budget Table
			/* -------------------------------------------------- */
			//Get leadTimeID
			$queryBudgetLeadTimeId = $dbOperation->connect()->query("SELECT leadTimeID FROM lead_time WHERE type = 'Budget'");
			$budgetLeadTimeId = "";
			if($resultBudgetLeadTimeId = $queryBudgetLeadTimeId->fetch()) {
				$budgetLeadTimeId .= $resultBudgetLeadTimeId->leadTimeID;
			}
			$budgetData = array(
				":leadTimeID" => $budgetLeadTimeId
			);
			//Get Last insert Id
			$budgetInsertId = $dbOperation->insertDataGetLastId("budget", $budgetData);
			/* -------------------------------------------------- */

			//For Accounting Table 
			/* -------------------------------------------------- */
			$queryAccountingLeadTimeId = $dbOperation->connect()->query("SELECT leadTimeID FROM lead_time WHERE type = 'Accounting'");
			$accountingLeadTimeId = "";
			if($resultAccountingLeadTimeId = $queryAccountingLeadTimeId->fetch()) {
				$accountingLeadTimeId .= $resultAccountingLeadTimeId->leadTimeID;
			}
			$accountingData = array(
				":leadTimeID" => $accountingLeadTimeId
			);
			//Get Last insert Id
			$accountingInsertId = $dbOperation->insertDataGetLastId("accounting", $accountingData);
			/* -------------------------------------------------- */

			//For Cash Advance Table
			/* -------------------------------------------------- */
			$cashAdvanceData = array(
				":adminID" => $_SESSION['user'],
				":userID" => $_POST['requestor'],
				":calID" => $getWeekNumber,
				":managerID" => $managerInsertId,
				":budgetID" => $budgetInsertId,
				":acctgID" => $accountingInsertId,
				":expenseID" => $_POST['expenseAccount'],
				":sectionID" => $_POST['section'],
				":dateCreated" => date("Y-m-d", strtotime($_POST['dateCreated'])),
				":dateEntered" => date("Y-m-d h:i:s"),
				":status" => "(For JGM)\n" . "Status: " . $_POST['status'],
				":state" => "Active",
				":purpose" => (!empty($_POST['purpose'])) ? $_POST['purpose'] : NULL,
				":remarks" => (!empty($_POST['cashAdvanceRemarks'])) ? $_POST['cashAdvanceRemarks'] : NULL,
				":cost" => $_POST['cost']
			);

			//Inserting To Cash Advance Data
			$queryCashAdvance = $dbOperation->insertData("ca", $cashAdvanceData);
			if($queryCashAdvance) {
				echo "Inserted Successfully";
			} else {
				return false;
			}
			/* -------------------------------------------------- */

		}
		elseif(isset($_POST['action']) == "Update") {

			//Get Manager ID
			/* -------------------------------------------------- */
		    $stmt = $dbOperation->connect()->query("SELECT managerID FROM ca WHERE caID = " . $_POST['id']);
		    $managerID = '';
		    while($row = $stmt->fetch()) {
		       $managerID = $row->managerID;
		    }
			/* -------------------------------------------------- */
			
			//Update Manager && CA Table
			/* -------------------------------------------------- */
			if($dbOperation->updateData("ca", array(
				":status" => "(For JGM)\n" . "Status: " . $_POST['status'],
				":purpose" => (!empty($_POST['purpose'])) ? $_POST['purpose'] : NULL,
				":remarks" => (!empty($_POST['cashAdvanceRemarks'])) ? $_POST['cashAdvanceRemarks'] : NULL,
				":cost" => $_POST['cost']
			), array(":caID" => $_POST['id'])) && $dbOperation->updateData("manager", array(
				":dateReceived" => (!empty($_POST['dateReceived'])) ? $_POST['dateReceived'] : NULL,
				":status" => $_POST['status'],
				":dateApproved" => (!empty($_POST['dateApproved'])) ? $_POST['dateApproved'] : NULL,
				":remarks" => (!empty($_POST['managerRemarks'])) ? $_POST['managerRemarks'] : NULL
			), array(":managerID" => $managerID))) {
				echo "Successfully updated!";
			}
			/* -------------------------------------------------- */
			
		}
	}