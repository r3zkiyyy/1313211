<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, phone, email, login, password) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $phone, $email, $login, $password])) {
        echo "Регистрация успешна!";
    } else {
        echo "Ошибка регистрации.";
    }
}
?>

<form method="post">
    <input type="text" name="name" placeholder="ФИО" required>
    <input type="text" name="phone" placeholder="Телефон" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="login" placeholder="Логин" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <button type="submit">Зарегистрироваться</button>
</form>
