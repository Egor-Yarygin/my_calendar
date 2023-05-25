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
                    <h1>Редактирование задачи<h1>
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
                                value="Принять изменения">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>