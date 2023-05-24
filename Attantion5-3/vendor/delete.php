<?php

require_once '../config/connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$itemId = $_POST['itemId'];

	// Выполните действия по удалению элемента с использованием переменной $itemId
	// ...

    mysqli_query($connect, "DELETE FROM `items` WHERE `items`.`id` = '$itemId'");
	$response = array('status' => 'success');
	echo json_encode($response);
	exit;
}
?>