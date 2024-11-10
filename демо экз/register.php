<?php
session_start();
require 'config.php'; // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хеширование пароля

    // Вставка нового пользователя в базу данных
    $stmt = $pdo->prepare("INSERT INTO users (fullname, username, password) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$fullname, $username, $password])) {
        echo "Регистрация успешна!";
        header("Location: login.php"); // Перенаправление на страницу входа
        exit();
    } else {
        echo "Ошибка регистрации.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нарушениям.нет - Регистрация</title>
</head>
<body>

<h1>Нарушениям.нет - Регистрация</h1>
<form method="post">
    <input type="text" name="fullname" placeholder="ФИО" required>
    <input type="text" name="username" placeholder="Логин" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <button type="submit">Зарегистрироваться</button>
</form>

<a href="index.php">Назад на главную</a>

</body>
</html>

