<?php 
    class DBCreds {
        public $servername;
        public $username;
        public $password;
        public $dbname;

        public function CreateConnection() {
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if($conn->connect_error) {
                die("SQL Connection Failed: " . $conn->connect_error);
            }
            return $conn;
        }
    }


    // Database Config
    $SQL_DB = new DBCreds();
    $SQL_DB->servername = "localhost";
    $SQL_DB->username = "root";
    $SQL_DB->password = "";
    $SQL_DB->dbname = "habits"
?>