
<?php
require_once '../config/connect.php';

//print_r($_POST);

$id  = $_POST['id'];
$moduleName = $_POST['moduleName'];
$MinSupportedVersion = $_POST['MinSupportedVersion'];
$ActualVersion = $_POST['ActualVersion'];
$Blacklist = $_POST['Blacklist'];

mysqli_query($connect, "UPDATE `items` SET `moduleName` = '$moduleName', `MinSupportedVersion` = '$MinSupportedVersion', `ActualVersion` = '$ActualVersion', `Blacklist` = '$Blacklist' WHERE `items`.`id` = '$id '");
header('Location: /');
?>