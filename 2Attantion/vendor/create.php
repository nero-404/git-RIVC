<?php
require_once '../config/connect.php';

//print_r($_POST);

$moduleName = $_POST['moduleName'];
$MinSupportedVersion = $_POST['MinSupportedVersion'];
$ActualVersion = $_POST['ActualVersion'];
$Blacklist = $_POST['Blacklist'];

mysqli_query($connect, "INSERT INTO `items` (`id`, `moduleName`, `MinSupportedVersion`, `ActualVersion`, `Blacklist`) VALUES (NULL, '$moduleName', '$MinSupportedVersion', '$ActualVersion', '$Blacklist')");

header('Location: /');