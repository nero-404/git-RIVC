<?php

    // Получаем значения переменных из POST-запроса
    $variable1 = $_POST['variable1'];
    $variable2 = $_POST['variable2'];
    $variable3 = $_POST['variable3'];
    $variable4 = $_POST['variable4'];
    $variable5 = $_POST['variable5'];

    // Используйте значения переменных в соответствующих операциях
    // Например, выполните какую-то обработку данных или сохраните их в базе данных

    // Верните ответ обратно клиенту (например, в формате JSON)


    $response = array('status' => 'success', 'message' => 'Данные успешно обработаны');
echo json_encode($response);



require_once 'connect.php';

//print_r($_POST);

$id  = $variable1;
$moduleName = $variable2;
$MinSupportedVersion = $variable3;
$ActualVersion = $variable4;
$Blacklist = $variable5;

mysqli_query($connect, "UPDATE `items` SET `moduleName` = '$moduleName', `MinSupportedVersion` = '$MinSupportedVersion', `ActualVersion` = '$ActualVersion', `Blacklist` = '$Blacklist' WHERE `items`.`id` = '$id '");


?>
