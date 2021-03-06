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
			/* -------------------------------------------------- */

            //For CCTL Table
			/* -------------------------------------------------- */
			//Get leadTimeID
			$queryCctlLeadTimeId = $dbOperation->connect()->query("SELECT leadTimeID FROM lead_time WHERE type = 'CCTL'");
			$cctlLeadTimeId = "";
			if($resultCctlLeadTimeId = $queryCctlLeadTimeId->fetch()) {
				$cctlLeadTimeId .= $resultCctlLeadTimeId->leadTimeID;
			}
			$cctlData = array(
				":leadTimeID" => $cctlLeadTimeId
			);
			//Get Last insert Id
			$cctlInsertId = $dbOperation->insertDataGetLastId("cctl", $cctlData);
            /* -------------------------------------------------- */
            

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

			//For Purchasing Table
			/* -------------------------------------------------- */
			//Get leadTimeID
			$queryPurchasingLeadTimeId = $dbOperation->connect()->query("SELECT leadTimeID FROM lead_time WHERE type = 'Purchasing'");
			$purchasingLeadTimeId = "";
			if($resultPurchasingLeadTimeId = $queryPurchasingLeadTimeId->fetch()) {
				$purchasingLeadTimeId .= $resultPurchasingLeadTimeId->leadTimeID;
			}
			$purchasingData = array(
				":leadTimeID" => $purchasingLeadTimeId
			);
			//Get Last insert Id
			$purchasingInsertId = $dbOperation->insertDataGetLastId("purchasing", $purchasingData);
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


			//For Purchase Request Table
			/* -------------------------------------------------- */
			$purchaseRequestData = array(
				":adminID" => $_SESSION['user'],
				":userID" => $_POST['requestor'],
				":calID" => $getWeekNumber,
				":managerID" => $managerInsertId,
				":cctlID" => $cctlInsertId,
				":budgetID" => $budgetInsertId,
				":purchasingID" => $purchasingInsertId,
				":acctgID" => $accountingInsertId,
				":expenseID" => $_POST['expenseAccount'],
				":sectionID" => $_POST['section'],
				":dateCreated" => date("Y-m-d", strtotime($_POST['dateCreated'])),
				":dateEntered" => date("Y-m-d h:i:s"),
				":refNo" =>  $_POST['refNo'],
				":status" => "(For JGM)\n" . "Status: " . $_POST['status'],
				":state" => "Active",
				":purpose" => (!empty($_POST['purpose'])) ? $_POST['purpose'] : NULL,
				":remarks" => (!empty($_POST['purchaseRequestRemarks'])) ? $_POST['purchaseRequestRemarks'] : NULL,
				":cost" => $_POST['cost'],
				":chargeTo" => $_POST['chargeTo']
			);

			//Inserting To Purchase Request Data
			$queryPurchaseRequest = $dbOperation->insertData("pr", $purchaseRequestData);
			if($queryPurchaseRequest) {
				echo "Inserted Successfully";
			} else {
				return false;
			}
			/* -------------------------------------------------- */

		}
		elseif(isset($_POST['action']) == "Update") {

			//Get Manager ID
			/* -------------------------------------------------- */
		    $stmt = $dbOperation->connect()->query("SELECT managerID FROM pr WHERE prID = " . $_POST['id']);
		    $managerID = '';
		    while($row = $stmt->fetch()) {
		       $managerID = $row->managerID;
		    }
			/* -------------------------------------------------- */
			
			//Update Manager && PR Table
			/* -------------------------------------------------- */
			if($dbOperation->updateData("pr", array(
				":status" => "(For JGM)\n" . "Status: " . $_POST['status'],
				":purpose" => (!empty($_POST['purpose'])) ? $_POST['purpose'] : NULL,
				":remarks" => (!empty($_POST['purchaseRequestRemarks'])) ? $_POST['purchaseRequestRemarks'] : NULL,
				":cost" => $_POST['cost']
			), array(":prID" => $_POST['id'])) && $dbOperation->updateData("manager", array(
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