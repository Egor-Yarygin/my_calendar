<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $theme = $_POST['theme'];
  $type = $_POST['type'];
  $location = $_POST['location'];
  $datetime = $_POST['datetime'];
  $duration = $_POST['duration'];
  $comment = $_POST['comment'];

  try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $db = new PDO($dsn, $username, $password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES => false
    ]);

    // Таблица"tasks", где хранятся дела
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

    $sql = "INSERT INTO tasks (theme, type, location, datetime, duration, comment)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $db->prepare($sql);
    $stmt->execute([$theme, $type, $location, $datetime, $duration, $comment]);

    header('Location: index.php');
    exit();

  } catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
  }

  
}

?>
