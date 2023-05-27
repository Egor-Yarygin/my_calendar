<?php
require 'config.php';


$filterType = $_GET['filterType'];
$taskDate = isset($_GET['taskDate']) ? $_GET['taskDate'] : '';

$taskDateFormatted = '';
if (!empty($taskDate)) {
    $taskDateFormatted = date('Y-m-d', strtotime($taskDate));
}

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $db = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

    $sql = "SELECT * FROM tasks";
    $params = [];
    
    switch ($filterType) {
      	case 'all-tasks':
            $sql .= "";
            break;
      	case 'current-tasks':
            $sql .= " WHERE datetime >= NOW() AND completed = 0";
            break;
        case 'overdue-tasks':
            $sql .= " WHERE datetime < NOW() AND completed = 0";
            break;
        case 'completed-tasks':
            $sql .= " WHERE completed = 1";
            break;
        case 'tasks-on-date':
            if (!empty($taskDate)) {
                $sql .= " WHERE DATE(datetime) = :taskDate";
                $params['taskDate'] = $taskDateFormatted;
            }
            break;
        case 'today':
            $sql .= " WHERE DATE(datetime) = CURDATE()";
            break;
        case 'tomorrow':
            $sql .= " WHERE DATE(datetime) = CURDATE() + INTERVAL 1 DAY";
            break;
        case 'this_week':
            $sql .= " WHERE WEEK(datetime, 1) = WEEK(NOW(), 1)";
            break;
        case 'next_week':
            $sql .= " WHERE WEEK(datetime, 1) = WEEK(NOW(), 1) + 1";
            break;
    }
    
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tasks as $task) {
        echo '<tr>';
        echo '<td>' . $task['type'] . '</td>';
        echo '<td>' . "<a href='editing.php?id=".$task['id']."'>".$task['theme']."</a>" . '</td>';
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