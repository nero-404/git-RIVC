<?php
require_once '../config/connect.php';

//print_r($_POST);

$moduleName = $_POST['moduleName'];
$MinSupportedVersion = $_POST['MinSupportedVersion'];
$ActualVersion = $_POST['ActualVersion'];
$Blacklist = $_POST['Blacklist'];


if(isset($data['AddLine'])){
	$error2 = array();
if(R::count('items', 'moduleName = ?', array($data['moduleName'])) > 0){
    $error2[] = 'название модуля занято';
}
}

    echo "<div>".array_shift($error2)."</div>";



mysqli_query($connect, "INSERT INTO `items` (`id`, `moduleName`, `MinSupportedVersion`, `ActualVersion`, `Blacklist`) VALUES (NULL, '$moduleName', '$MinSupportedVersion', '$ActualVersion', '$Blacklist')");

// header('Location: /');