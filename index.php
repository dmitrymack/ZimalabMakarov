<?php
	include_once 'database.php';
	include_once 'client.php';

	$db = new Database();
	$db = $db->getConnection();

	$client = new Client($db);

	if($_POST){
		$arr = array($_POST['first_name'], $_POST['last_name'], $_POST['email'], 
			$_POST['company_name'], $_POST['position'], $_POST['phone_1'], 
			$_POST['phone_1'], $_POST['phone_2'], $_POST['phone_3']);
		if ($client->create($arr)) {
        	echo "<div class='alert alert-success container'>Клиент Добавлен!</div>";
    	}
    	else {
    		echo "<div class='alert alert-danger container'>Невозможно добавить клиента.</div>";
    	}
	}
	$read = $client->readAll();
?>




<!DOCTYPE html>
<html lang="ru">

	<head>
		<meta charset="UTF-8">
		<title>Test Task</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>

	<body>
		<div align="center" class="container pt-3"><h3>Добавить клиента</h3></div>
		<form action="index.php" method='post'>
		  <div class="form-group pt-4">
		  	<div class="container">
			  	<div class="row">
				    <div class="col">
				      <input type="text" class="form-control" name = "first_name" placeholder="Имя" required>
				    </div>
				    <div class="col">
				      <input type="text" class="form-control" name = "last_name"placeholder="Фамилия" required>
				    </div>
				    <div class="col">
				      <input type="email" class="form-control" name = "email"placeholder="email" required>
				    </div>
				    <div class="col">
				      <input type="text" class="form-control" name = "company_name"placeholder="Компания">
				    </div>
				    <div class="col">
				      <input type="text" class="form-control" name = "position"placeholder="Должность">
				    </div>
		  		</div>
		  		<br>
		  		<div class="row">
				    <div class="col-md-3 offset-md-2">
				      <input type="tel" class="form-control" name = "phone_1"placeholder="Телефон 1">
				    </div>
				    <div class="col-md-3">
				      <input type="tel" class="form-control" name = "phone_2"placeholder="Телефон 2">
				    </div>
				    <div class="col-md-3">
				      <input type="tel" class="form-control" name = "phone_3"placeholder="Телефон 3">
				    </div>
				    
		  		</div>
		  		<div align="center" class="pt-3">
		  			<button type="submit" class="btn btn-outline-dark btn-lg">Добавить</button>
		  			<button type="reset" class="btn btn-outline-dark btn-lg">Сброс</button>
		  		</div>
		    </div>
		  </div>
		</form>
		<div align="center" class="container pt-5"><h3>Список клиентов</h3></div>
		<div class="container pt-4">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Имя</th>
					<th scope="col">Фамилия</th>
					<th scope="col">email</th>
					<th scope="col">Компания</th>
					<th scope="col">Должность</th>
					<th scope="col">Телефон 1</th>
					<th scope="col">Телефон 2</th>
					<th scope="col">Телефон 3</th>
				</tr>
		  	</thead>
			<tbody>
				<?php
				$i = 1;
				while($row = $read->fetch()){
					extract($row);
					echo "<tr>";
						echo "<th scope='row'>$i</th>";
						echo "<td>$first_name</td>";
						echo "<td>$last_name</td>";
						echo "<td>$email</td>";
						echo "<td>$company_name</td>";
						echo "<td>$position</td>";
						echo "<td>$phone_1</td>";
						echo "<td>$phone_2</td>";
						echo "<td>$phone_3</td>";
					echo "</tr>";
					$i++;
				}
				?>
			</tbody>
		</table>
	</div>
	</body>
	
</html>

