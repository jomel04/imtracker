<?php
	namespace System\Classes\Database;
	class DatabaseOperation extends Connection {

		//Fetch all data
		public function fetchAllData() {
			try {
				$stmt = $this->connect()->prepare("SELECT ca.caID, ca.dateCreated, ca.dateEntered, banana_calendars.week_number, banana_calendars.period_number, expense_account.type AS ExpenseAccount, section.type AS Section, ca.requestor, ca.purpose, ca.remarks, ca.cost, lead_time.leadTime AS LeadTime, manager.dateReceived, manager.status AS Status, manager.dateApproved AS DateApproved,manager.remarks AS ManagerRemarks , DATEDIFF(manager.dateApproved, manager.dateReceived) AS NoOfDays FROM ca INNER JOIN manager ON ca.managerID = manager.managerID INNER JOIN banana_calendars ON ca.calID = banana_calendars.calID INNER JOIN expense_account ON ca.expenseID = expense_account.expenseID INNER JOIN section ON ca.sectionID = section.sectionID INNER JOIN lead_time ON ca.leadTimeID = lead_time.leadTimeID WHERE manager.status != 'Approved'");
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

		//Fetch selected row
		public function selectRow($table, $data) {
			try {
				$stmt = $this->connect()->prepare("SELECT * FROM {$table} WHERE " . implode(",", str_replace(":", "", array_keys($data))) . " = " . implode(",", array_keys($data)));
				$stmt->execute($data);
				$result = $stmt->fetchAll();
				if(!$result) {
					return false;
				}
				return $result;
				$this->disconnect();
			} catch(\PDOException $e) {
				echo $e->getMessage();
			}
	    }

	    //Insert Data
		public function insertData($table, $data) {
			try {
				$stmt = $this->connect()->prepare("INSERT INTO {$table} " . "(" . str_replace(":", "", implode(", ", array_keys($data))) . ") VALUES(" . implode(", ", array_keys($data)) . ")");
				$result = $stmt->execute($data);
				if(!$result) {
					return false;
				}
				return $result;
				$this->disconnect();
			} catch(\PDOException $e) {
				echo $e->getMessage();
			}
		}

		//Insert Data and get last ID
		public function insertDataGetLastId($table, $data) {
			try {
				$stmt = $this->connect()->prepare("INSERT INTO {$table} " . "(" . str_replace(":", "", implode(", ", array_keys($data))) . ") VALUES(" . implode(", ", array_keys($data)) . ")");
				$result = $stmt->execute($data);
				if(!$result) {
					return false;
				}
				return $this->conn->lastInsertId();
				$this->disconnect();
			} catch(\PDOException $e) {
				echo $e->getMessage();
			}
		}


		public function updateData($table, $data, $where) {
			try {
				$datas = array();
				foreach($data as $key => $value) {
					$datas[] = str_replace(":", "", $key) . " = " . $key;
				}
				$stmt = $this->connect()->prepare("UPDATE {$table} SET " . implode(", ", $datas) . " WHERE " . implode(", ", str_replace(":", "", array_keys($where))) . " = " . implode(", ", array_keys($where)));
				$getAllData = array_merge($data, $where);
				$result = $stmt->execute($getAllData);
				if(!$result) {
					return false;
				}
				return $result;
				$this->disconnect();
			} catch(\PDOException $e) {
				echo $e->getMessage();
			}
		}
		//Delete Data
		public function deleteData($table, $id) {
			try {
				$stmt = $this->connect()->prepare("DELETE FROM {$table} WHERE " . str_replace(":", "", array_keys($id)) . " = " . array_keys($id));
				$result = $stmt->execute($id);
				if(!$result) {
					return false;
				}
				return $result;
				$this->disconnect();
			} catch(\PDOException $e) {
				echo $e->getMessage();
			}
		}

		// again where clause is left optional
public function dbRowUpdate($table_name, $form_data, $where_clause='')
{
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);

    // append the where statement
    $sql .= $whereSQL;

    // run and return the query result
    return $sql;
}

function dbRowDelete($table_name, $where_clause='')
{
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM ".$table_name.$whereSQL;

    // run and return the query result resource
    return mysql_query($sql);
}

	}
