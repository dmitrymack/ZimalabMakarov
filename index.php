<!DOCTYPE html>
<html lang="ru">

	<head>
		<meta charset="UTF-8">
		<title>Test Task</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>

	<body>
		<div align="center" class="container pt-3"><h3>Добавить клиента</h3></div>
		<form>
		  <div class="form-group pt-4">
		  	<div class="container">
			  	<div class="row">
				    <div class="col">
				      <input type="text" class="form-control" placeholder="Имя">
				    </div>
				    <div class="col">
				      <input type="text" class="form-control" placeholder="Фамилия">
				    </div>
				    <div class="col">
				      <input type="email" class="form-control" placeholder="email">
				    </div>
				    <div class="col">
				      <input type="text" class="form-control" placeholder="Компания">
				    </div>
				    <div class="col">
				      <input type="text" class="form-control" placeholder="Должность">
				    </div>
		  		</div>
		  		<br>
		  		<div class="row">
				    <div class="col-md-3 offset-md-2">
				      <input type="tel" class="form-control" placeholder="Телефон 1">
				    </div>
				    <div class="col-md-3">
				      <input type="tel" class="form-control" placeholder="Телефон 2">
				    </div>
				    <div class="col-md-3">
				      <input type="tel" class="form-control" placeholder="Телефон 3">
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
				<tr>
					<th scope="row">1</th>
					<td>Mark</td>
					<td>Otto</td>
					<td>@mdo</td>
				</tr>
			</tbody>
		</table>
	</div>
	</body>
	
</html>