<?php
require "db.php";

if ($_GET['id'] =='') {
	header('Location: /table.php?id='.$_SESSION['logged_user']->id);
}

if ($_GET['id'] ==$_SESSION['logged_user']->id) {
	$position = 'signin';
}
else{
	$position = 'nosignin';
}
$user = R::findOne('users', 'id = ?', array($_GET['id']));
?>

	<!DOCTYPE html>
	<html lang="en" >
	<head>
	<meta charset="UTF-8">
	<title>ControlVersion</title>
	<link rel="stylesheet" href="str/table.css">

	</head>
	<body>
	<!-- partial:index.partial.html -->
	<?php if ($position == 'signin'): ?>
		<div class="container">
			<table>
				<thead>
					<tr>
						<th>Id</th>
						<th>moduleName</th>
						<th>MinSupportedVersion</th>
						<th>ActualVersion</th>
						<th>Blacklist</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Cell 1</td>
						<td>Cell 2</td>
						<td>Cell 3</td>
						<td>Cell 4</td>
						<td>Cell 5</td>
					</tr>
					<tr>
						<td>Cell 1</td>
						<td>Cell 2</td>
						<td>Cell 3</td>
						<td>Cell 4</td>
						<td>Cell 5</td>
					</tr>
					<tr>
						<td>Cell 1</td>
						<td>Cell 2</td>
						<td>Cell 3</td>
						<td>Cell 4</td>
						<td>Cell 5</td>
					</tr>
					<tr>
						<td>Cell 1</td>
						<td>Cell 2</td>
						<td>Cell 3</td>
						<td>Cell 4</td>
						<td>Cell 5</td>
					</tr>
					<tr>
						<td>Cell 1</td>
						<td>Cell 2</td>
						<td>Cell 3</td>
						<td>Cell 4</td>
						<td>Cell 5</td>
					</tr>
				</tbody>
			</table>
		</div>
	<?php endif ?>
	<div class="exit_button">
			<a href = "/logout.php"><button>Выйти</button></a>
		</div>
	<!-- partial -->
	
	</body>
	</html>
	

