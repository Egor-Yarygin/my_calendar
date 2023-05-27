<?php

require 'task_list.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'], $_POST['type'], $_POST['datetime'])) {
    if (isset($_POST['submit'])) {
      $taskId = $_GET['id'];

      $query = $db->prepare("UPDATE tasks SET theme = :theme, type = :type, location = :location, datetime = :datetime, duration = :duration, comment = :comment WHERE id = :taskId");
      $params = [
          ':theme' => $_POST['theme'],
          ':type' => $_POST['type'],
          ':location' => $_POST['location'],
          ':datetime' => $_POST['datetime'],
          ':duration' => $_POST['duration'],
          ':comment' => $_POST['comment'],
          ':taskId' => $taskId
      ];
      $query->execute($params);

      header("Location: index.php");
      exit();
    } elseif (isset($_POST['delete'])) {
			$taskId = $_GET['id'];

      $query = $db->prepare("DELETE FROM tasks WHERE id = :taskId");
      $params = [
          ':taskId' => $taskId
      ];
      $query->execute($params);

      header("Location: index.php");
      exit();
    }
}
?>