<?php
session_start();
require 'config.php'; // Подключение к базе данных

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_number = $_POST['car_number'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    // Вставка нового заявления в базу данных
    $stmt = $pdo->prepare("INSERT INTO statements (user_id, car_number, description, status) VALUES (?, ?, ?, 'new')");
    
    if ($stmt->execute([$user_id, $car_number, $description])) {
        echo "Заявление подано успешно!";
        header("Location: index.php"); // Перенаправление на главную страницу
        exit();
    } else {
        echo "Ошибка подачи заявления.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нарушениям.нет - Подача заявления</title>
</head>
<body>

<h1>Нарушениям.нет - Подача заявления</h1>
<form method="post">
    <input type="text" name="car_number" placeholder="Госномер автомобиля" required>
    <textarea name="description" placeholder="Описание нарушения" required></textarea>
    <button type="submit">Подать заявление</button>
</form>

<a href="index.php">Назад на главную</a>

</body>
</html>
