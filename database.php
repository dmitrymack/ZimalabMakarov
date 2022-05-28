<?php
	class Database{
		private $host = "localhost";
		private $db_name = "clients";
		private $user = "user";
		private $pass = "user";
		public $conn;

		public function getConnection() {
	        $this->conn = null;
	        
	        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->pass);

        	return $this->conn;
    	}

	}
?>