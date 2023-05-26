<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $taskId = $_GET['id'];

        try {
            $dsn = "mysql:host=$host;dbname=$dbname";
            $db = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);

            $sql = "UPDATE tasks SET completed = true WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$taskId]);

            header('Location: index.php');
            exit();
        } catch (PDOException $e) {
            echo 'Ошибка: ' . $e->getMessage();
        }
    }
}