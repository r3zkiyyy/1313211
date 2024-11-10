<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_number = $_POST['car_number'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO complaints (user_id, car_number, description, status) VALUES (?, ?, ?, 'new')");
    if ($stmt->execute([$user_id, $car_number, $description])) {
        echo "Заявление подано!";
    } else {
        echo "Ошибка при подаче заявления.";
    }
}
?>

<form method="post">
    <input type="text" name="car_number" placeholder="ГРН автомобиля" required>
    <textarea name="description" placeholder="Описание нарушения" required></textarea>
    <button type="submit">Подать заявление</button>
</form>
