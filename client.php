<?php
	class Client{
		private $conn;
		private $table;

		public function __construct($db, $table){
			$this->conn = $db;
			$this->table = $table;
		}

		public function create(array $resp){
			$query = "INSERT INTO $this->table
				(first_name, last_name, email, company_name, position, phone_1, phone_2, phone_3)
				VALUES ('$resp[0]', '$resp[1]', '$resp[2]', '$resp[3]', '$resp[4]', 
					'$resp[5]', '$resp[6]', '$resp[7]')";
			$add = $this->conn->prepare($query);
			return $add->execute();
		}

		public function readPage($from, $limit){
			$query = "SELECT * FROM $this->table LIMIT $from, $limit";
			$read = $this->conn->prepare($query);
			$read->execute();
			return $read;
		} 

		public function length(){
			$query = "SELECT COUNT(*) FROM $this->table";
			$count = $this->conn->prepare($query);
			$count->execute();
			return $count->fetch()[0];
		}

		public function getIdThroughEmailField($email){
			$query = "SELECT id FROM $this->table WHERE email='$email'";
			$id = $this->conn->prepare($query);
			$id->execute();
			return $id->fetch()['id'];
		}

		public function delete($id){
			$query = "DELETE FROM $this->table WHERE id = $id";
			$del = $this->conn->prepare($query);
			return $del->execute();
		}

		public function readOneById($id){
			$query = "SELECT * FROM $this->table WHERE id='$id'";
			$one = $this->conn->prepare($query);
			$one->execute();
			return $one;
		}

		public function update($id, array $resp){
			$query = "UPDATE $this->table SET
				first_name = '$resp[0]',
				last_name = '$resp[1]',
				email = '$resp[2]',
				company_name = '$resp[3]',
				position = '$resp[4]',
				phone_1 = '$resp[5]',
				phone_2 = '$resp[6]', 
				phone_3 = '$resp[7]'
				WHERE id = $id";
			$upd = $this->conn->prepare($query);
			return $upd->execute();
		}
		public function checkPhone($phone){
			if($phone == '') return false;

			$query = "SELECT COUNT(*) FROM clients 
			WHERE phone_1 = $phone or phone_2 = $phone or phone_3 = $phone";
			$count = $this->conn->prepare($query);
			$count->execute();
			return $count->fetch()[0] > 0;
		}
		public function checkEmail($email){
			$query = "SELECT COUNT(*) FROM clients 
			WHERE email = '$email'";
			$count = $this->conn->prepare($query);
			$count->execute();
			return $count->fetch()[0] > 0;
		}
	}
?>