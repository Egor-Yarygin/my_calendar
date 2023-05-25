<?php
require 'task_list.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Менеджер задач</title>
</head>

<body>
    <div class="main">
        <div>
            <h1>Мой календарь<h1>
        </div>
        <!--Форма для добавления новой задачи-->
        <div>
            <h2>Новая задача</h2>
        </div>
        <div class="add-task">

            <form action="add_task.php" method="POST">
                <label for="theme">Тема:</label>
                <input type="text" id="theme" name="theme" required><br>

                <label for="type">Тип:</label>
                <select id="type" name="type">
                    <option value="meeting">Встреча</option>
                    <option value="call">Звонок</option>
                    <option value="meeting">Совещание</option>
                    <option value="task">Дело</option>
                </select><br>

                <label for="location">Место:</label>
                <input type="text" id="location" name="location"><br>

                <label for="datetime">Дата и время:</label>
                <input type="datetime-local" id="datetime" name="datetime" required><br>

                <label for="duration">Длительность:</label>
                <input type="text" id="duration" name="duration"><br>

                <label for="comment">Комментарий:</label>
                <textarea id="comment" name="comment" class="comment"></textarea><br>

                <input type="submit" value="Добавить задачу">
            </form>
        </div>
        <div class="main-task">
            <div>
                <h2>Список задач</h2>
            </div>
            <div class="task-list">
                <!-- Ссылки на различные списки задач -->
                <select id="task-list" onchange="changeTaskList()">
                    <option value="current-tasks">Текущие задачи</option>
                    <option value="overdue-tasks">Просроченные задачи</option>
                    <option value="completed-tasks">Выполненные задачи</option>
                    <option value="tasks-on-date">Задачи на конкретную дату</option>
                </select>
                <table>
                    <thead>
                        <tr>
                            <th>Тип</th>
                            <th>Тема</th>
                            <th>Место</th>
                            <th>Дата и время</th>
                            <th>Длительность</th>
                            <th>Комментарий</th>
                            <th>Статус</th> <!-- Добавляем новый заголовок для столбца статуса -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $task) : ?>
                            <tr>
                                <td><?php echo $task['type']; ?></td>
                                <td><?php echo $task['theme']; ?></td>
                                <td><?php echo $task['location']; ?></td>
                                <td><?php echo $task['datetime']; ?></td>
                                <td><?php echo $task['duration']; ?></td>
                                <td><?php echo $task['comment']; ?></td>
                                <td>
                                    <?php if ($task['completed']): ?>
                                        <span class="completed">Выполнено</span>
                                    <?php else: ?>
                                        <a href="mark_completed.php?id=<?php echo $task['id']; ?>">Пометить выполненным</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    function changeTaskList() {
        var select = document.getElementById("task-list");
        var selectedOption = select.options[select.selectedIndex].value;

        // Перенаправление пользователя на соответствующую страницу списка задач
        window.location.href = selectedOption + ".php";
    }
</script>

</body>