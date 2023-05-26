<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Получение данных из формы
  $theme = $_POST['theme'];
  $type = $_POST['type'];
  $location = $_POST['location'];
  $datetime = $_POST['datetime'];
  $duration = $_POST['duration'];
  $comment = $_POST['comment'];

  try {
    // Подключение к базе данных
    $dsn = "mysql:host=$host;dbname=$dbname";
    $db = new PDO($dsn, $username, $password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES => false
    ]);

    // Создание таблицы "tasks", если она не существует
    $createTableSQL = "CREATE TABLE IF NOT EXISTS tasks (
      id INT AUTO_INCREMENT PRIMARY KEY,
      theme VARCHAR(255) NOT NULL,
      type VARCHAR(50) NOT NULL,
      location VARCHAR(255),
      datetime DATETIME NOT NULL,
      duration VARCHAR(50),
      comment TEXT,
      completed BOOLEAN DEFAULT false
    )";
    $db->exec($createTableSQL);

    // Подготовка SQL-запроса для вставки задачи
    $sql = "INSERT INTO tasks (theme, type, location, datetime, duration, comment)
            VALUES (?, ?, ?, ?, ?, ?)";

    // Подготовка и выполнение запроса
    $stmt = $db->prepare($sql);
    $stmt->execute([$theme, $type, $location, $datetime, $duration, $comment]);

    // Перенаправление пользователя на главную страницу или страницу со списком задач
    header('Location: index.php');
    exit();

  } catch (PDOException $e) {
    // Обработка ошибки подключения к базе данных
    echo 'Ошибка: ' . $e->getMessage();
  }

  
}

?>
