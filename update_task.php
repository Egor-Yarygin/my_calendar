<?php
require 'task_list.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверяем, если переданы необходимые данные
    if (isset($_POST['theme'], $_POST['type'], $_POST['datetime'])) {
        $taskId = $_GET['id']; // Получаем идентификатор задачи из URL
        
        // Обновляем информацию о задаче в базе данных
        $query = $db->prepare("UPDATE tasks SET theme = :theme, type = :type, location = :location, datetime = :datetime, duration = :duration, comment = :comment WHERE id = :taskId");
        $query->bindParam(':theme', $_POST['theme'], PDO::PARAM_STR);
        $query->bindParam(':type', $_POST['type'], PDO::PARAM_STR);
        $query->bindParam(':location', $_POST['location'], PDO::PARAM_STR);
        $query->bindParam(':datetime', $_POST['datetime'], PDO::PARAM_STR);
        $query->bindParam(':duration', $_POST['duration'], PDO::PARAM_STR);
        $query->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
        $query->bindParam(':taskId', $taskId, PDO::PARAM_INT);
        $query->execute();
        
        // Перенаправляем обратно на страницу со списком задач
        header("Location: index.php");
        exit();
    }
}
?>
