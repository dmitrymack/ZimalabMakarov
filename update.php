<?php
	include_once 'database.php';
	include_once 'client.php';
	include_once 'functions.php';

	$db = new Database();
	$db = $db->getConnection();

	$client = new Client($db, 'clients');
	$one = null;
	$id = null;

	if($_GET){
		$id = $_GET['id']; // параметр id далее записывается в скрытое поле
		$one = $client->readOneById($id)->fetch();
	}
	if($_POST){

		if(isset($_POST['id'])){
    		$id = $_POST['id']; // получение данных из скрытого поля id
    		$one = $client->readOneById($id)->fetch();
    	}

		$arr = array($_POST['first_name'], $_POST['last_name'], $_POST['email'], 
			$_POST['company_name'], $_POST['position'], 
			$_POST['phone_1'], $_POST['phone_2'], $_POST['phone_3']);

		if(checkPhones($client, $_POST['phone_1'], 
			$_POST['phone_2'], $_POST['phone_3'])) 
		{

			// вывод сообщений об успехе или неудаче
			if ($client->update($id, $arr)) {
	        	echo "<div class='alert alert-success container'>Данные клиента изменены!</div>";
	    	}
	    	else {
	    		echo "<div class='alert alert-danger container'>Невозможно изменить данные клиента.</div>";
	    	}
    	}
	}

?>

<!DOCTYPE html>
<html lang="ru">

	<head>
		<meta charset="UTF-8">
		<title>Test Task</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>

	<body>
		<div align="center" class="container pt-3"><h3>Изменить данные клиента</h3></div>
		<form action="update.php" method='post'>
		  <div class="form-group pt-4">
		  	<div class="container">
			  	<div class="row">
				    <div class="col">
				      <input type="text" class="form-control" name = "first_name" placeholder="Имя"
				      <?php if($one) { // ставим значения данных выбранного клиента
				      	$a = $one['first_name']; echo "value='$a'";
				      } ?> required>
				    </div>
				    <div class="col">
				      <input type="text" class="form-control" name = "last_name"placeholder="Фамилия" 
				      <?php if($one) {
				      	$a = $one['last_name']; echo "value='$a'";
				      } ?> required>
				    </div>
				    <div class="col">
				      <input type="email" class="form-control" name = "email"placeholder="email"
				      <?php if($one) {
				      	$a = $one['email']; echo "value='$a'";
				      } ?> required>
				    </div>
				    <div class="col">
				      <input type="text" class="form-control" name = "company_name"placeholder="Компания"
				      <?php if($one) {
				      	$a = $one['company_name']; echo "value='$a'";
				      } ?>>
				    </div>
				    <div class="col">
				      <input type="text" class="form-control" name = "position"placeholder="Должность" 
				      <?php if($one) {
				      	$a = $one['position']; echo "value='$a'";
				      } ?>>
				    </div>
		  		</div>
		  		<br>
		  		<div class="row">
				    <div class="col-md-3 offset-md-2">
				      <input type="tel" class="form-control" name = "phone_1"placeholder="Телефон 1"
				      <?php if($one) {
				      	$a = $one['phone_1']; echo "value='$a'";
				      } ?>>
				    </div>
				    <div class="col-md-3">
				      <input type="tel" class="form-control" name = "phone_2"placeholder="Телефон 2"
				      <?php if($one) {
				      	$a = $one['phone_2']; echo "value='$a'";
				      } ?>>
				    </div>
				    <div class="col-md-3">
				      <input type="tel" class="form-control" name = "phone_3"placeholder="Телефон 3"
				      <?php if($one) {
				      	$a = $one['phone_3']; echo "value='$a'";
				      } ?>>
				    </div>
				    <input type='hidden' name='id' value=<?php echo "$id" ?>>
		  		</div>
		  		<div align="center" class="pt-3">
		  			<button type="submit" class="btn btn-outline-dark btn-lg">Изменить</button>
		  		</div>
		    </div>
		  </div>
		</form>
		<div align="center"><a href="index.php"><button class="btn btn-outline-dark btn-lg">На главную</button></a></div>
	</body>
</html>