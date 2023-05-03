<?php
  require_once 'config/connect.php';
?>
<?php
require "db.php";

if ($_GET['id'] =='') {
	header('Location: /table.php?id='.$_SESSION['logged_user']->id);
}
if ($_GET['id'] == $_SESSION['logged_user']->id) {
	$position = 'signin';
}
$user = R::findOne('users', 'id = ?', array($_GET['id']));
?>

<!DOCTYPE html>
<html lang="en" >
	<head>
		<meta charset="UTF-8">
		<title>1ControlVersion</title>
		<link rel="stylesheet" href="table.css">

	</head>
	<body>
		





	<div class="exit_button">
			<a href = "/logout.php"><button><ion-icon name="exit-outline"></ion-icon></button></a>
		</div>
		<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
		<h2>Добавить новую строку</h2>
				<form action="vendor/create.php" method="post">
					<p>Название модуля</p>
					<input type="text" name="moduleName">
					<p>минимально поддерживаемая версия</p>
					<input type="number" name="MinSupportedVersion" step="any">
					<p>актуальная версия</p>
					<input type="number" name="ActualVersion" step="any">
					<p>чёрный список</p>
					<input type="number" name="Blacklist" step="any">
					<button type="submit">Добавить</button>
				</form>
		
		<?php if ($position == 'signin'): ?>
			<div class="container">
				<script src="table.js"></script>
				
				<p class='sort'><button onclick="sortTable()"><ion-icon name="funnel-outline"></ion-icon>Сортировать</button></p>
				<input class="form-control" type="text" placeholder='Search' id="search-text" onkeyup="tableSearch()">
				<h3 class='search'><ion-icon name="search-outline"></ion-icon></h3>

				<table class="table table-striped" id="info-table">
				<div class="container">

					<thead>
					<tr>
            			
            			<th>Название модуля</th>
            			<th>Минимально поддерживаемая версия</th>
            			<th>Актуальная версия</th>
            			<th>Чёрный список</th>
      					<th>&#9998;</th>
     					<th>&#10006;</th>
       	 			</tr>
		     		</thead>
				
					<?php
				$products = mysqli_query($connect, "SELECT * FROM `items`");
				$products = mysqli_fetch_all($products);
				foreach($products as $product) {
					?> 
					<tr>
						<td><?= $product[1] ?></td>
						<td><?= $product[2] ?></td>
						<td><?= $product[3] ?></td>
						<td><?= $product[4] ?></td> 
						<td><div class = "button_link"><a href="updatePage.php?id=<?= $product[0] ?>"><button>Обновить</button></a></div></td>
						<td><div class = "button_link"><a href="vendor/delete.php?id=<?= $product[0] ?>"><button>Удалить</button></a></td> 
					</tr>

				<?php
				}
				?>
				</table>  
				
				
				
			</div>
			<?php elseif ($position == 'nosignin'): ?>
			<?php endif ?>
	
	</body>
</html>
	

