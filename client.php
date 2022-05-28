<?php
	class Client{
		private $conn;
		private $table = "clients";

		public function __construct($db){
			$this->conn = $db;
		}

		public function create(array $resp){
			$query = "INSERT INTO $this->table
				(first_name, last_name, email, company_name, position, phone_1, phone_2, phone_3)
				VALUES ('$resp[0]', '$resp[1]', '$resp[2]', '$resp[3]', '$resp[4]', 
					'$resp[5]', '$resp[6]', '$resp[7]')";
			$add = $this->conn->prepare($query);
			return $add->execute();
		}

		public function readAll(){
			$query = "SELECT * FROM $this->table";
			$read = $this->conn->prepare($query);
			$read->execute();
			return $read;
		} 
	}
?>