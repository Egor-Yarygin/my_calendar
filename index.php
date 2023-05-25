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
                                <option value="meeting">Встреча</option>
                                <option value="call">Звонок</option>
                                <option value="meeting">Совещание</option>
                                <option value="task">Дело</option>
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
                        <select style="font-family: 'Comic Sans MS';" id="type" name="type">
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
                            <a href="#">Сегодня</a>
                            <a href="#">Завтра</a>
                            <a href="#">На эту неделю</a>
                            <a href="#">На следующую неделю</a>
                        </div>
                    </div>
                    <div>
                        <table>
                            <thead>
                                <tr class="table-elements">
                                    <th>Тип</th>
                                    <th>Тема</th>
                                    <th>Место</th>
                                    <th>Дата и время</th>
                                    <th>Длительность</th>
                                    <th>Комментарий</th>
                                </tr>
                            </thead>
                            <tbody id="task-list-body">
                                <?php foreach ($tasks as $task): ?>
                                    <tr>
                                        <td>
                                            <?php echo $task['type']; ?>
                                        </td>
                                        <td>
                                            <?php echo $task['theme']; ?>
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
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</body>

</html>