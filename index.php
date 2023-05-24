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

            <form>
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
                <textarea id="comment" name="comment"></textarea><br>

                <input type="submit" value="Добавить задачу">
            </form>
        </div>
        <div class="main-task">
            <div>
                <h2>Список задач</h2>
            </div>
            <div class="task-list">
                <!-- Ссылки на различные списки задач -->
                <select id="task-list">
                    <option value="current-tasks">Текущие задачи</option>
                    <option value="overdue-tasks">Просроченные задачи</option>
                    <option value="completed-tasks">Выполненные задачи</option>
                    <option value="tasks-on-date">Задачи на конкретную дату</option>
                </select>
            </div>
        </div>
    </div>

</body>

</html>
</body>

</html>
bbbboba