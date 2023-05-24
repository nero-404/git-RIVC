<?php

    // Получаем значения переменных из POST-запроса
    $itemId = $_POST['itemId'];

    // Используйте значения переменных в соответствующих операциях
    // Например, выполните какую-то обработку данных или сохраните их в базе данных

    // Верните ответ обратно клиенту (например, в формате JSON)


    $response = array('status' => 'success', 'message' => 'Данные успешно обработаны');
echo json_encode($response);



require_once 'connect.php';
mysqli_query($connect, "DELETE FROM `items` WHERE `items`.`id` = '$itemId'");


?>
