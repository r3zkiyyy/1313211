<?php
session_start();
require 'db.php';

if ($_SESSION['login'] !== 'сорр' || $_SESSION['password'] !== 'password') {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->query("SELECT c.*, u.name FROM complaints c JOIN users u ON c.user_id = u.id");
$complaints = $stmt->fetchAll();
foreach ($complaints as $complaint) {
    echo "ФИО: " . htmlspecialchars($complaint['name']) . "<br>";
    echo "ГРН: " . htmlspecialchars($complaint['car_number']) . "<br>";
    echo "Описание: " . htmlspecialchars($complaint['description']) . "<br>";
    echo "Статус: " . htmlspecialchars($complaint['status']) . "<br>";
    
    // Форма для изменения статуса
    echo '<form method="post">
            <input type="hidden" name="complaint_id" value="' . htmlspecialchars($complaint['id']) . '">
            <select name="status">
                <option value="confirmed">Подтверждено</option>
                <option value="rejected">Отклонено</option>
            </select>
            <button type="submit">Изменить статус</button>
          </form><br>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $complaint_id = $_POST['complaint_id'];

    $stmt = $pdo->prepare("UPDATE complaints SET status = ? WHERE id = ?");
    if ($stmt->execute([$status, $complaint_id])) {
        echo "Статус обновлен!";
        header('Location: admin.php'); // Перезагрузка страницы для обновления списка
        exit;
    } else {
        echo "Ошибка при обновлении статуса.";
    }
}
?>
