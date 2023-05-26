<?php
require 'config.php';

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $db = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

    $sql = "SELECT * FROM tasks";
    $stmt = $db->query($sql);

    $tasks = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $tasks[] = $row;
    }
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
