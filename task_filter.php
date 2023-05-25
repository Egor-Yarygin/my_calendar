<?php
require_once 'config.php';

// Получение выбранного типа задачи из запроса
$selectedType = $_POST['type'];

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $db = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

    $sql = '';

    // Проверка выбранного типа задачи и формирование соответствующего SQL-запроса
    switch ($selectedType) {
        case 'current-tasks':
            // Запрос для текущих задач (не просроченных)
            $sql = "SELECT * FROM tasks WHERE datetime >= NOW() ORDER BY datetime ASC";
            break;
        case 'overdue-tasks':
            // Запрос для просроченных задач
            $sql = "SELECT * FROM tasks WHERE datetime < NOW() ORDER BY datetime ASC";
            break;
        case 'completed-tasks':
            // Запрос для выполненных задач
            $sql = "SELECT * FROM tasks WHERE completed = true ORDER BY datetime ASC";
            break;
        case 'tasks-on-date':
            // Запрос для задач на конкретную дату
            $selectedDate = $_GET['date']; // Получение выбранной даты из запроса
            $sql = "SELECT * FROM tasks WHERE DATE(datetime) = :selectedDate ORDER BY datetime ASC";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':selectedDate', $selectedDate);
            $stmt->execute();
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            break;
        default:
            // Если выбран неизвестный тип, возвращаем пустой результат
            $tasks = [];
            break;
    }

    // Возвращаем список задач в формате JSON
    header('Content-Type: application/json');
    echo json_encode($tasks);
} catch (PDOException $e) {
    // Обработка ошибок
    echo 'Ошибка: ' . $e->getMessage();
}