<?php
$host = 'localhost'; // адрес сервера 
$database = 'mysql'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}
?>
