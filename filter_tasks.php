<?php
require_once 'config.php';

$filterType = $_GET['filterType'];
$taskDate = $_GET['taskDate'];

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $db = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

    $sql = "SELECT * FROM tasks";

    switch ($filterType) {
        case 'overdue-tasks':
            $sql .= " WHERE datetime < NOW() AND completed = 0";
            break;
        case 'completed-tasks':
            $sql .= " WHERE completed = 1";
            break;
        case 'tasks-on-date':
            $sql .= " WHERE DATE(datetime) = STR_TO_DATE(:taskDate, '%d.%m.%Y')";
            break;
    }

    $stmt = $db->prepare($sql);

    if ($filterType === 'tasks-on-date' && !empty($taskDate)) {
        $sql .= " AND DATE(datetime) = :taskDate";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':taskDate', $taskDate);
    } else {
        $stmt = $db->prepare($sql);
    }

    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tasks as $task) {
        echo '<tr>';
        echo '<td>' . $task['type'] . '</td>';
        echo '<td>' . $task['theme'] . '</td>';
        echo '<td>' . $task['location'] . '</td>';
        echo '<td>' . $task['datetime'] . '</td>';
        echo '<td>' . $task['duration'] . '</td>';
        echo '<td>' . $task['comment'] . '</td>';
        echo '<td>';
        if ($task['completed']) {
            echo '<span class="completed">Выполнено</span>';
        } else {
            echo '<a href="mark_completed.php?id=' . $task['id'] . '">Пометить выполненным</a>';
        }
        echo '</td>';
        echo '</tr>';
    }
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
?>