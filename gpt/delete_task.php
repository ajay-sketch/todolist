<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'];

    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $task_id);
    $stmt->execute();

    echo "Task deleted";

    $stmt->close();
    $conn->close();
}
