<?php
  require_once 'config/connect.php';
  $product_id = $_GET['id'];
  $product = mysqli_query($connect, "SELECT * FROM `items` WHERE `id`='$product_id'");
  $product = mysqli_fetch_assoc($product);
  //print_r($product);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Обновление товара</title>
</head>
<body>

  <a href="/">Главная</a>
  <hr>




  <h2>Обновить товар</h2>
  <form action="vendor/update.php" method="post">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <p>Название модуля</p>
    <input type="text" name="moduleName" value="<?= $product['moduleName'] ?>">
    <p>минимально поддерживаемая версия</p>
    <input type="number" name="MinSupportedVersion" value="<?= $product['MinSupportedVersion'] ?>">
    <p>актуальная версия</p>
    <input type="number" name="ActualVersion" value="<?= $product['ActualVersion'] ?>">
    <p>чёрный список</p>
    <input type="number" name="Blacklist" value="<?= $product['Blacklist'] ?>">
    
    
    <button type="submit">Обновить</button>
  </form>
  



  
</body>
</html>