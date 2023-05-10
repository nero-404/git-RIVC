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
		<link rel="stylesheet" href="sas.css">
		<!-- <link rel="stylesheet" href="InputForm.css"> -->

	</head>
	<body>
		





	<div class="exit_button">
			<a href = "/logout.php"><button><ion-icon name="exit-outline"></ion-icon></button></a>
		</div>
		<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
		

		
		<?php if ($position == 'signin'): ?>
			<div class="container">
				<script src="table.js"></script>
				
				<p class='sort'><button onclick="sortTable()"><ion-icon name="funnel-outline"></ion-icon>Сортировать</button></p>
				<input class="form-control" type="text" placeholder='Поиск..' id="search-text" onkeyup="tableSearch()">
				<h3 class='search'><ion-icon name="search-outline"></ion-icon></h3>

				<table class="table table-striped" id="info-table">
				<div class="container">

					<thead>
					<tr>
            			
            			<th>Название модуля</th>
            			<th>Минимально поддерживаемая версия</th>
            			<th>Актуальная версия</th>
            			<th>Чёрный список</th>
						<th class="space">&#9998;</th>
						<th class="space">&#10006;</th>
      					
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
						<td><div class = "button_link"><a href="updatePage.php?id=<?= $product[0] ?>"><button>Редактировать</button></a></div></td>
						<td><div class = "button_link"><a href="vendor/delete.php?id=<?= $product[0] ?>"><button>Удалить</button></a></td> 
					</tr>

				<?php
				}
				?>
				</table>  
				
			
			
				<br>
				<button id="openModal" class="plus">+</button>


			</div>



			<div class="modal">
					<div class="modal-content">
						<span class="close">&times;</span>
						


						<form method="post" class = "AddNewLine">
							<h2>Добавить новую строку</h2> 
							<label>Название модуля</label>
							<div class="group">      
								<input type="text" name="moduleName" required>
								<span class="highlight"></span>
								<span class="bar"></span>
								
							</div>
							<p>минимально поддерживаемая версия</p>
							<input type="number" name="MinSupportedVersion" step="any">
							<p>актуальная версия</p>
							<input type="number" name="ActualVersion" step="any">
							<p>чёрный список</p>
							<input type="number" name="Blacklist" step="any">





							<?php
							$data = $_POST;

							if(isset($data['addline'])){
							$error = array();
							if(R::count('items', 'moduleName = ?', array($data['moduleName'])) > 0){
								$errorq[] = 'Название модуля уже используется';
							}

							if(empty($errorq)){
								$allgood = 'allgood';
								$moduleName = $_POST['moduleName'];
								$MinSupportedVersion = $_POST['MinSupportedVersion'];
								$ActualVersion = $_POST['ActualVersion'];
								$Blacklist = $_POST['Blacklist'];

								mysqli_query($connect, "INSERT INTO items (id, moduleName, MinSupportedVersion, ActualVersion, Blacklist) VALUES (NULL, '$moduleName', '$MinSupportedVersion', '$ActualVersion', '$Blacklist')");
								// header('Location: /');
								
								}else{
								echo "<div class = error>".array_shift($errorq)."</div>";
								$allgood = 'allbad';
							}
							}
						
							?>
							<button name = "addline" class="btn" type="submit" onClick="refreshPage()">Добавить </button>
							
						</form>



					</div>
				</div>
			<?php elseif ($position == 'nosignin'): ?>
			<?php endif ?>
	
			<script>
				

				
				var modal = document.querySelector('.modal');

				var btn = document.querySelector('#openModal');
				var closeBtn = document.querySelector('.close');
				btn.onclick = function() {
				modal.style.display = "block";
				}

				// When the user clicks on <span> (x), close the modal
				closeBtn.onclick = function() {
				modal.style.display = "none";
				}

				// When the user clicks anywhere outside of the modal, close it
				window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
				}
			</script>
			<!-- test -->
	</body>
</html>
	

