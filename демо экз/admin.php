<?php
session_start();
require 'config.php';

// Проверка на авторизацию администратора
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Получение всех заявлений
$stmt = $pdo->prepare("SELECT s.*, u.fullname FROM statements s JOIN users u ON s.user_id = u.id");
$stmt->execute();
$statements = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Обработка изменения статуса
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'], $_POST['statement_id'])) {
    $status = $_POST['status'];
    $statement_id = $_POST['statement_id'];

    $update_stmt = $pdo->prepare("UPDATE statements SET status = ? WHERE id = ?");
    if ($update_stmt->execute([$status, $statement_id])) {
        echo "Статус заявления обновлен!";
        header("Refresh: 0"); // Перезагрузить страницу
        exit();
    } else {
        echo "Ошибка при обновлении статуса.";
    }
}
?>

<h1>Панель администратора</h1>

<h2>Все заявления</h2>
<table border="1">
    <tr>
        <th>ФИО</th>
        <th>Госномер</th>
        <th>Описание нарушения</th>
        <th>Статус</th>
        <th>Изменить статус</th>
    </tr>
    <?php foreach ($statements as $statement): ?>
        <tr>
            <td><?php echo htmlspecialchars($statement['fullname']); ?></td>
            <td><?php echo htmlspecialchars($statement['car_number']); ?></td>
            <td><?php echo htmlspecialchars($statement['description']); ?></td>
            <td><?php echo htmlspecialchars($statement['status']); ?></td>
            <td>
                <form method="post">
                    <select name="status">
                        <option value="new" <?php if ($statement['status'] == 'new') echo 'selected'; ?>>Новое</option>
                        <option value="confirmed" <?php if ($statement['status'] == 'confirmed') echo 'selected'; ?>>Подтверждено</option>
                        <option value="rejected" <?php if ($statement['status'] == 'rejected') echo 'selected'; ?>>Отклонено</option>
                    </select>
                    <input type="hidden" name="statement_id" value="<?php echo $statement['id']; ?>">
                    <button type="submit">Изменить статус</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="admin_logout.php">Выйти из панели администратора</a>
