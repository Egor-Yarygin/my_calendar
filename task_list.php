<?php
require_once 'config.php';

try {
    // Подключение к базе данных
    $dsn = "mysql:host=$host;dbname=$dbname";
    $db = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

    // Запрос на получение всех задач
    $sql = "SELECT * FROM tasks";
    $stmt = $db->query($sql);

    // Создание массива для хранения задач
    $tasks = [];

    // Перебор результатов запроса и добавление задач в массив
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $tasks[] = $row;
    }
} catch (PDOException $e) {
    // Обработка ошибки подключения к базе данных
    echo 'Ошибка: ' . $e->getMessage();
}
