<?php
    namespace System\Classes\Database;
    class Connection {
        public $conn;
        public function connect() {
            try {
                $this->conn = new \PDO("mysql:host=localhost;dbname=imtracker;charset=utf8mb4;", "root", "", array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
                return $this->conn;
            } catch(\PDOException $e) {
                echo "Connection error " . $e->getMessage();
                return false;
            }
        }
        public function disconnect() {
            $this->conn = null;
        }
    }
