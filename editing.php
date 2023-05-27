<?php
require 'task_list.php';

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    $query = $db->prepare("SELECT * FROM tasks WHERE id = :taskId");
    $query->bindParam(':taskId', $taskId, PDO::PARAM_INT);
    $query->execute();
    $task = $query->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Редактирование задачи</title>
</head>

<body>
    <div class="main">
        <div class="border">
            <div class="main-add-task">
                <div>
                    <h1>Редактирование задачи</h1>
                </div>
                <div class="add-task">
                    <form class="add-task-form" action="update_task.php?id=<?php echo $task['id']; ?>" method="POST">
                        <div>
                            <label for="theme">Тема:</label>
                            <input type="text" id="theme" name="theme" value="<?php echo $task['theme']; ?>" required>
                        </div>

                        <div>
                            <label for="type">Тип:</label>
                            <select style="font-family: 'Comic Sans MS';" id="type" name="type">
                                <option value="Встреча" <?php if ($task['type'] === 'Встреча') echo 'selected'; ?>>Встреча</option>
                                <option value="Звонок" <?php if ($task['type'] === 'Звонок') echo 'selected'; ?>>Звонок</option>
                                <option value="Совещание" <?php if ($task['type'] === 'Совещание') echo 'selected'; ?>>Совещание</option>
                                <option value="Дело" <?php if ($task['type'] === 'Дело') echo 'selected'; ?>>Дело</option>
                            </select>
                        </div>

                        <div>
                            <label for="location">Место:</label>
                            <input type="text" id="location" name="location" value="<?php echo $task['location']; ?>">
                        </div>

                        <div>
                            <label for="datetime">Дата и время:</label>
                            <input style="font-family: 'Comic Sans MS';" type="datetime-local" id="datetime" name="datetime"
                                value="<?php echo date('Y-m-d\TH:i', strtotime($task['datetime'])); ?>" required>
                        </div>

                        <div>
                            <label for="duration">Длительность:</label>
                            <input type="text" id="duration" name="duration" value="<?php echo $task['duration']; ?>">
                        </div>

                        <div>
                            <label for="comment">Комментарий:</label>
                            <textarea id="comment" name="comment" class="comment"><?php echo $task['comment']; ?></textarea><br>
                            <input type="submit" name="submit" value="Принять изменения">
                            <input style="color:white; background-color:red;"  type="submit" name="delete" value="Удалить задачу">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>