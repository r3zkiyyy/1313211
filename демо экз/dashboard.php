<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_number = $_POST['car_number'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO statements (user_id, car_number, description) VALUES (?, ?, ?)");
    if ($stmt->execute([$user_id, $car_number, $description])) {
        echo "Заявление подано!";
    } else {
        echo "Ошибка при подаче заявления.";
    }
}

$stmt = $pdo->prepare("SELECT * FROM statements WHERE user_id = ?");
$stmt->execute([$user_id]);
$statements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Личный кабинет</h1>

<h2>Ваши заявления</h2>
<ul>
<?php foreach ($statements as $statement): ?>
    <li><?php echo htmlspecialchars($statement['description']) . " - Статус: " . htmlspecialchars($statement['status']); ?></li>
<?php endforeach; ?>
</ul>

<h2>Подать новое заявление</h2>
<form method="post">
    <input type="text" name="car_number" placeholder="Госномер автомобиля" required>
    <textarea name="description" placeholder="Описание нарушения" required></textarea>
    <button type="submit">Подать заявление</button>
</form>

<a href="logout.php">Выйти</a>
