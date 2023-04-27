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
	
	<p><button onclick="sortTable()">Сортировать</button></p>

		<!-- partial:index.partial.html -->
		<?php if ($position == 'signin'): ?>
			<div class="container">
				<script src="table.js"></script>
				
				<input class="form-control" type="text" placeholder="search" id="search-text" onkeyup="tableSearch()">
				
				<table class="table table-striped" id="info-table">
				<div class="container">
					<thead>
					<tr>
            			<th>Id</th>
            			<th>moduleName</th>
            			<th>MinSupportedVersion</th>
            			<th>ActualVersion</th>
            			<th>Blacklist</th>
       	 			</tr>
					<tr>
						<td>eeeee</td>
						<td>ddddd</td>
						<td>aaaa</td>
						<td>5</td>
						<td>aaa</td>
					</tr>
					<tr>
						<td>dddddd</td>
						<td>eeeee</td>
						<td>cccc</td>
						<td>4</td>
						<td>bbbb</td>
					</tr>
					<tr>
							<td>cccc</td>
							<td>cccc</td>
							<td>bbbb</td>
							<td>3</td>
							<td>cccc</td>
					</tr>
					<tr>
							<td>bbb 1</td>
							<td>bbbb</td>
							<td>eeeee</td>
							<td>2</td>
							<td>dddd</td>
					</tr>
					<tr>
							<td>aaaa</td>
							<td>aaaa</td>
							<td>bbbb</td>
							<td>1</td>
							<td>eeee</td>
					</tr>
					</thead>
				<tbody>
				</tbody>
				</table>  
			</div>
			<?php endif ?>
	<div class="exit_button">
			<a href = "/logout.php"><button>Выйти</button></a>
		</div>
	</body>
</html>
	

