<?php
	function checkPhones($client, $phone1, $phone2, $phone3){
		if($client->checkPhone($phone1)){
			echo "<div class='alert alert-danger container'>Номер $phone1 уже есть в базе.</div>";
			return false;
		}
		if($client->checkPhone($phone2)){
			echo "<div class='alert alert-danger container'>Номер $phone2 уже есть в базе.</div>";
			return false;
		}
		if($client->checkPhone($phone3)){
			echo "<div class='alert alert-danger container'>Номер $phone3 уже есть в базе.</div>";
			return false;
		}
		return true;
	}

	function hasEmail($client, $email){
		if($client->checkEmail($email)){
			echo "<div class='alert alert-danger container'>Email $email уже есть в базе.</div>";
			return false;
		}
		return true;
	}
?>