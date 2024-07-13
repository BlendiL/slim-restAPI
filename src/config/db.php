<?php
    class db {
        // Properties
        private $dbhost = 'localhost';
        private $dbuser = 'root';
        private $dbpass = '';
        private $dbname = 'smvf';
    
        // Connect
        public function connect() {
            try {
                $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
                $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
                $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $dbConnection;
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
    }
    
	?>