<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="register.php">Регистрация</a></li>
            <li><a href="login.php">Вход</a></li>
            <li><a href="submit_complaint.php">Подать заявление</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="admin.php">Панель администратора</a></li>
                <li><a href="logout.php">Выход</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <h1>Добро пожаловать на портал «Нарушениям. Нет»</h1>
    <p>Здесь вы можете зарегистрироваться, войти в систему и подать заявление о нарушении.</p>
</body>
</html>
