<?php
require 'config.php';

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $db = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

    $sql = "SELECT * FROM tasks WHERE completed = false";
    $stmt = $db->query($sql);

    $tasks = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $tasks[] = $row;
    }
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}

foreach ($tasks as $task) {
    echo "<tr>";
    echo "<td>" . $task['type'] . "</td>";
    echo "<td>" . $task['theme'] . "</td>";
    echo "<td>" . $task['location'] . "</td>";
    echo "<td>" . $task['datetime'] . "</td>";
    echo "<td>" . $task['duration'] . "</td>";
    echo "<td>" . $task['comment'] . "</td>";
    echo "</tr>";
}
