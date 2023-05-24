<?php
  require_once 'config/connect.php';
?>




<?php
require "db.php";

if ($_GET['id'] =='') {
	if (isset($_GET['errorMessage'])) {
		header('Location: /table.php?id='.$_SESSION['logged_user']->id."&errorMessage=" . $_GET['errorMessage']);
	}
	else {
		header('Location: /table.php?id='.$_SESSION['logged_user']->id);
	}
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


		
		<?php if ($position == 'signin'): ?>
			<div class="container">
				<script src="table.js"></script>
				
				<p class='sort'><button onclick="sortTable()"><ion-icon name="funnel-outline"></ion-icon>Сортировать</button></p>
				<input class="form-control" type="text" placeholder='Search' id="search-text" onkeyup="tableSearch()">
				<h3 class='search'><ion-icon name="search-outline"></ion-icon></h3>

				<table class="table table-striped" id="info-table">

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
					
						
						<td>
							<div class="button_link">
								<button onclick="openModal('<?= $product[0] ?>', '<?= $product[1] ?>', '<?= $product[2] ?>', '<?= $product[3] ?>', '<?= $product[4] ?>')">Редактировать</button>
							</div>
						</td>

						<td>
							<div class="button_link">
								<button onclick="openModal3('<?= $product[0] ?>')">Удалить</button>
							</div>
						</td>
					</tr>

					<?php
						}
					?>
				</table>
				<br>
				<button class="plus" onclick="openModal2()">+</button>
				
				
				
			</div>
 




			<!-- Модальное окно 1 EDIT -->
			<div id="myModal1" class="modal">
				<div class="modal-content">
					<span class="close" onclick="closeModal('myModal1')">&times;</span>
					<h2>Редактировать строку</h2>
					<form>

						
						<input type="hidden" id="input1" class="modalInput" readonly>
						
						
						<input type="hidden" id="input2" class="modalInput"><br>
						<label for="input3">Минимально поддерживаемая версия:</label> <br><br>
						<input type="text" id="input3" class="modalInput"> <hr><br>
						<label for="input4">Актуальная версия:</label><br><br>
						<input type="text" id="input4" class="modalInput"><br>
						
						<input type="hidden" id="input5" class="modalInput">
						<hr><br>
						<button type="button" onclick="saveInput()">Сохранить</button>
					</form>
				</div>
			</div>






			<!-- Модальное окно 2 ADD -->
			<div id="myModal2" class="modal">
				<div class="modal-content">
					<span class="close" onclick="closeModal('myModal2')">&times;</span>
					<h2>Добавить новую строку</h2>
					<form action="vendor/create.php" method="post">
						<p>Название модуля</p>
						<input type="text" name="moduleName">
						<p>минимально поддерживаемая версия</p>
						<input type="text" name="MinSupportedVersion" step="any">
						<p>актуальная версия</p>
						<input type="text" name="ActualVersion" step="any">
						<!-- <p>чёрный список</p>-->
						<input type="hidden" name="Blacklist" step="any"><br>
						<button class="dob" type="submit">Добавить</button><br>
					</form>
				</div>
			</div>


			<!-- Модальное окно 3 DELETE -->
			<div id="myModal3" class="modal">
				<div class="modal-content">
					<span class="close" onclick="closeModal('myModal3')">&times;</span>
					<h2>Удаление строки</h2>
					<p>Вы действительно хотите удалить?</p>
					<input id="deleteItemId" name="deleteItemId" type="hidden">
					<button onclick="deleteItem()">Удалить</button>
				</div>
			</div>


			<div id="myModal" class="modal">
				<div class="modal-content">
					
					<p id="modal-message"></p>
					<button id="modal-okButton">Окей</button>
				</div>
			</div>



			<?php
				if (isset($_GET['errorMessage'])) {
					$errorMessage = $_GET['errorMessage'];
					?>
					<script>
					window.addEventListener("load", function() {
						var errorMessage = "<?php echo $errorMessage; ?>";
						var modal = document.getElementById("myModal");
						var modalMessage = document.getElementById("modal-message");
						var modalOKButton = document.getElementById("modal-okButton");
						modalMessage.textContent = errorMessage;

						// Показать модальное окно
						modal.style.display = "block";

						// Закрытие модального окна при клике на "закрыть" (крестик)
						var closeButton = document.getElementsByClassName("close")[0];
						closeButton.addEventListener("click", function() {
							modal.style.display = "none";
						});

						// Закрытие модального окна при клике вне окна
						window.addEventListener("click", function(event) {
							if (event.target === modal) {
								modal.style.display = "none";
							}
						});

						// Выполнить действия после нажатия на кнопку "Окей"
						modalOKButton.addEventListener("click", function() {
							// Выполните здесь нужные действия после нажатия на кнопку "Окей"
							// Например, перенаправление на другую страницу:
							window.location.href = "table.php";
						});
					});
					</script>
					<?php
				}
			?>





		<?php elseif ($position == 'nosignin'): ?>

		<?php endif ?>
	


		<script>



			function openModal(variable1, variable2, variable3, variable4, variable5) {
				var modal = document.getElementById("myModal1");
				var modalInputs = document.getElementsByClassName("modalInput");

				// Заполняем значениями переданные переменные
				modalInputs[0].value = variable1;
				modalInputs[1].value = variable2;
				modalInputs[2].value = variable3;
				modalInputs[3].value = variable4;
				modalInputs[4].value = variable5;

				modal.style.display = "block";
			}
			function openModal3(itemId) {
				var modal = document.getElementById("myModal3");
				var deleteItemId = document.getElementById("deleteItemId");

				deleteItemId.value = itemId;
				modal.style.display = "block";
			}



			function deleteItem() {
				// Получите значение ID элемента для удаления
				var itemId = document.getElementById("deleteItemId").value;

				// Создайте объект FormData и добавьте переменную itemId
				var formData = new FormData();
				formData.append("itemId", itemId);

				// Создаем XMLHttpRequest-объект
				var xhr = new XMLHttpRequest();

				// Устанавливаем метод и URL-адрес запроса
				xhr.open("POST", "delete.php", true);

				// Отправляем запрос на сервер
				xhr.send(formData);

				// Обработка ответа сервера
				xhr.onload = function () {
					if (xhr.status === 200) {
					// Если запрос успешен, получаем ответ от сервера
					var response = JSON.parse(xhr.responseText);
					console.log(response); // Выводим ответ в консоль
					// Дополнительные действия с ответом сервера, если необходимо

					// Перезагрузка страницы
					if (response.status == 'success') {
						location.reload(); // Перезагрузка страницы
					}
					} else {
					console.error("Ошибка запроса: " + xhr.status);
					}
					closeModal("myModal1"); // Закрываем модальное окно после отправки данных
				};
			}




			function saveInput() {
				// Получаем значения из input-полей
				var variable1 = document.getElementById("input1").value;
				var variable2 = document.getElementById("input2").value;
				var variable3 = document.getElementById("input3").value;
				var variable4 = document.getElementById("input4").value;
				var variable5 = document.getElementById("input5").value;

				// Создаем объект FormData и добавляем значения переменных
				var formData = new FormData();
				formData.append("variable1", variable1);
				formData.append("variable2", variable2);
				formData.append("variable3", variable3);
				formData.append("variable4", variable4);
				formData.append("variable5", variable5);

				// Создаем XMLHttpRequest-объект
				var xhr = new XMLHttpRequest();

				// Устанавливаем метод и URL-адрес запроса
				xhr.open("POST", "process.php", true);

				// Отправляем запрос на сервер
				xhr.send(formData);

				// Обработка ответа сервера
				xhr.onload = function () {
					if (xhr.status === 200) {
					// Если запрос успешен, получаем ответ от сервера
					var response = JSON.parse(xhr.responseText);
					console.log(response); // Выводим ответ в консоль
					// Дополнительные действия с ответом сервера, если необходимо

					// Перезагрузка страницы
					if (response.status == 'success') {
						location.reload(); // Перезагрузка страницы
					}
					} else {
					console.error("Ошибка запроса: " + xhr.status);
					}
					closeModal("myModal1"); // Закрываем модальное окно после отправки данных
				};
			}



			

			function closeModal(modalId) {
				var modal = document.getElementById(modalId);
				modal.style.display = "none";
			}

			function openModal2() {
				var modal = document.getElementById("myModal2");
				modal.style.display = "block";
			}

			window.addEventListener("mousedown", function(event) {
				var modal1 = document.getElementById("myModal1");
				var modal2 = document.getElementById("myModal2");
				var modal3 = document.getElementById("myModal3");

				if (event.target === modal1) {
					modal1.style.display = "none";
				}

				if (event.target === modal2) {
					modal2.style.display = "none";
				}

				if (event.target === modal3) {
					modal3.style.display = "none";
				}
			});
		</script>



	</body>
</html>
	
