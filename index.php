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
        <div class="border">
            <div class="main-add-task">
                <div>
                    <h1>Мой календарь<h1>
                </div>
                <!--Форма для добавления новой задачи-->
                <div>
                    <h3>Новая задача</h3>
                </div>
                <div class="add-task">
                    <form class="add-task-form" action="add_task.php" method="POST">
                        <div>
                            <label for="theme">Тема:</label>
                            <input type="text" id="theme" name="theme" required>
                        </div>

                        <div>
                            <label for="type">Тип:</label>
                            <select style="font-family: 'Comic Sans MS';" id="type" name="type">
                                <option value="Встреча">Встреча</option>
                                <option value="Звонок">Звонок</option>
                                <option value="Совещание">Совещание</option>
                                <option value="Дело">Дело</option>
                            </select>
                        </div>

                        <div>
                            <label for="location">Место:</label>
                            <input type="text" id="location" name="location">
                        </div>

                        <div>
                            <label for="datetime">Дата и время:</label>
                            <input style="font-family: 'Comic Sans MS';" type="datetime-local" id="datetime"
                                name="datetime" required>
                        </div>

                        <div>
                            <label for="duration">Длительность:</label>
                            <input type="text" id="duration" name="duration">
                        </div>

                        <div>
                            <label for="comment">Комментарий:</label>
                            <textarea id="comment" name="comment" class="comment"></textarea><br>
                            <input style="font-family: 'Comic Sans MS'; margin-left:7.7vw;" type="submit"
                                value="Добавить задачу">
                        </div>

                    </form>
                </div>
            </div>
            <div class="main-task">
                <div>
                    <h3>Список задач</h3>
                </div>
                <div class="task-list">
                    <div class="task-list-row">
                        <select style="font-family: 'Comic Sans MS';" id="filter-type" name="filter-type">
                            <option value="current-tasks">Текущие задачи</option>
                            <option value="overdue-tasks">Просроченные задачи</option>
                            <option value="completed-tasks">Выполненные задачи</option>
                            <option value="tasks-on-date">Задачи на конкретную дату</option>
                        </select>
                        <div class="date-picker">
                            <label for="task-date">Выберите дату:</label>
                            <input type="date" id="task-date" name="task-date">
                        </div>
                        <div class="quick-links">
                        <a href="filter_tasks.php?filterType=tasks-on-date&taskDate=<?php echo date('Y-m-d'); ?>">Сегодня</a>
<a href="filter_tasks.php?filterType=tasks-on-date&taskDate=<?php echo date('Y-m-d', strtotime('+1 day')); ?>">Завтра</a>
<a href="filter_tasks.php?filterType=tasks-on-date&taskDate=<?php echo date('Y-m-d', strtotime('this week')); ?>">На эту неделю</a>
<a href="filter_tasks.php?filterType=tasks-on-date&taskDate=<?php echo date('Y-m-d', strtotime('next week')); ?>">На следующую неделю</a>

                        </div>
                    </div>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Тип</th>
                                    <th>Тема</th>
                                    <th>Место</th>
                                    <th>Дата и время</th>
                                    <th>Длительность</th>
                                    <th>Комментарий</th>
                                    <th>Статус</th>
                                </tr>
                            </thead>
                            <tbody id="task-list-body">
                                <?php foreach ($tasks as $task): ?>
                                    <tr>
                                        <td>
                                            <?php echo $task['type'] ?>
                                        </td>
                                        <td>
                                            <?php echo "<a href='./editing.php'>".$task['theme']."</a>" ?>
                                        </td>
                                        <td>
                                            <?php echo $task['location']; ?>
                                        </td>
                                        <td>
                                            <?php echo $task['datetime']; ?>
                                        </td>
                                        <td>
                                            <?php echo $task['duration']; ?>
                                        </td>
                                        <td>
                                            <?php echo $task['comment']; ?>
                                        </td>
                                        <td>
                                            <?php if ($task['completed']): ?>
                                                <span class="completed">Выполнено</span>
                                            <?php else: ?>
                                                <a href="mark_completed.php?id=<?php echo $task['id']; ?>">Пометить
                                                    выполненным</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <script>
                                function filterTasks() {
                                    var filterType = document.getElementById("filter-type").value;
                                    var taskDate = document.getElementById("task-date").value;

                                    var xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            document.getElementById("task-list-body").innerHTML = xhr.responseText;
                                        }
                                    };

                                    xhr.open("GET", "filter_tasks.php?filterType=" + filterType + "&taskDate=" + taskDate, true);
                                    xhr.send();
                                }

                                document.getElementById("filter-type").addEventListener("change", filterTasks);
                                document.getElementById("task-date").addEventListener("change", filterTasks);
                        </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>