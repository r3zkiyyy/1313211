<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нарушениям.нет - Главная страница</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        nav {
            margin-bottom: 20px;
        }
        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #007BFF;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<nav>
    <a href="register.php">Регистрация</a>
    <a href="login.php">Вход</a>
    <a href="submit_statement.php">Подача заявления</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php">Выход</a>
    <?php endif; ?>
</nav>

<h1>Нарушениям.нет</h1>
<p>Добро пожаловать! Выберите действие из меню выше.</p>

</body>
</html>
