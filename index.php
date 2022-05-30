<?php
	include_once 'database.php';
	include_once 'client.php';
	include_once 'functions.php';


	$db = new Database(); // класс Database создан мной
	$db = $db->getConnection(); // подключение к базе

	$client = new Client($db, 'clients');

	if(isset($_POST['del'])){ // удаление из базы и вывод сообщения вверху страницы
		if ($client->delete($_POST['del'])) {
        	echo "<div class='alert alert-success container'>Клиент Удален!</div>";
    	}
    	else {
    		echo "<div class='alert alert-danger container'>Невозможно удалить клиента.</div>";
    	}
	}

	if(isset($_POST['first_name']) and isset($_POST['last_name']) and 
		isset($_POST['email']) and hasEmail($client, $_POST['email']) and
		checkPhones($client, 
			$_POST['phone_1'], $_POST['phone_2'], $_POST['phone_3']))
	{
		// создание массива из данных post запроса
		$arr = array($_POST['first_name'], $_POST['last_name'], $_POST['email'], 
			$_POST['company_name'], $_POST['position'], 
			$_POST['phone_1'], $_POST['phone_2'], $_POST['phone_3']);

		if ($client->create($arr)) { 
		// добавление в базу и вывод сообщений вверху страницы
        	echo "<div class='alert alert-success container'>
        		Клиент Добавлен!</div>";
    	}
    	else {
    		echo "<div class='alert alert-danger container'>
    			Невозможно добавить клиента.</div>";
    	}
	}

	// создание пагинации
	if (isset($_GET['page'])) {
    	$page = $_GET['page'];
	} 
	else { 
    	$page = 1;
	}

	$limit = 10;
	$total = ceil($client->length() / $limit);

	// если пользователь сам введет некорректное значение в поисковик
	if($page <= 0) $page = 1;
	else if ($page > $total) $page = $total;
	
	$from = ($page - 1) * $limit;
	
	$read = $client->readPage($from, $limit);

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
					<th scope="col">Действия</th>
				</tr>
		  	</thead>
			<tbody>
				<?php
				$i = $from + 1;
				$change = "<img src='https://www.citypng.com/public/uploads/preview/hd-blue-outline-short-pencil-icon-png-171630344411iwptmifhy2.png' width='20' height='20'";
				$del = "<img src='https://upload.wikimedia.org/wikipedia/commons/thumb/c/cc/Cross_red_circle.svg/1200px-Cross_red_circle.svg.png' width='20' height='20'";

				while($row = $read->fetch()){
					extract($row);
					$id = $client->getIdThroughEmailField($email);
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
						echo "<td><div class='row'>
						<form action='update.php' method='get'>
							<button class='btn btn-light'>$change</button>
							<input type='hidden' name='id' value='$id' />
						</form>
						<form action='index.php' method='post'>
							<button class='btn btn-light'>$del</button>
							<input type='hidden' name='del' value='$id' />
						</form>
						</div></td>";
					echo "</tr>";
					$i++;
				}
				?>
			</tbody>
		</table>
	<?php  
		echo "<div class='row'>";
		// кнопка First (в начало)
	    echo "<div class='col-md-1 offset-md-4'><a href='?page=1'><button class='btn btn-outline-dark'>First</button></a></div>";

	    //кнопка Prev (предыдущая страница)
	    echo "<div class='col-md-1'><a href='?page=". ($page - 1) . "'>
	    	<button class='btn btn-outline-dark'";
	    if($page <= 1) echo " disabled";
	    echo ">Prev</button></a></div>";

	    // кнопка Next (следующее)
	    echo "<div class='col-md-1'><a href='?page=". ($page + 1) . "'>
	    	<button class='btn btn-outline-dark'";
	    if($page >= $total) echo " disabled";
	    echo ">Next</button></a></div>";

	    //кнопка Last (в конец)
	    echo "<div class='col-md-1'><a href='?page=$total'>
	    	<button class='btn btn-outline-dark'>Last</button></a></li></div>";

	    echo "</div><br>";
    ?>
    
	</div>
	</body>
	
</html>

