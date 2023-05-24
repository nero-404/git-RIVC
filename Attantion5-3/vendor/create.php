<?php
require_once '../config/connect.php';

$moduleName = $_POST['moduleName'];
$MinSupportedVersion = $_POST['MinSupportedVersion'];
$ActualVersion = $_POST['ActualVersion'];
$Blacklist = $_POST['Blacklist'];

$host = 'localhost';
$db = 'RIVC';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}

$stmt = $pdo->prepare("SELECT COUNT(*) FROM items WHERE moduleName = :moduleName");
$stmt->bindParam(':moduleName', $moduleName);
$stmt->execute();
$count = $stmt->fetchColumn();

if ($count > 0) {
    // Значение moduleName уже существует в базе данных
    $errorMessage = "Название модуля занято";
    echo $errorMessage;
    echo "<script>openErrorModal('$errorMessage');</script>";
    header("Location: /table.php?errorMessage=" . urlencode($errorMessage));
    exit();
} else {
    mysqli_query($connect, "INSERT INTO `items` (`id`, `moduleName`, `MinSupportedVersion`, `ActualVersion`, `Blacklist`) VALUES (NULL, '$moduleName', '$MinSupportedVersion', '$ActualVersion', '$Blacklist')");
    echo "success";
    header("Location: ../");
    exit();
    }
?>



