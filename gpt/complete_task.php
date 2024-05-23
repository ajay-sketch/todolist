<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'];

    $stmt = $conn->prepare("UPDATE tasks SET is_completed = 1 WHERE id = ?");
    $stmt->bind_param("i", $task_id);
    $stmt->execute();

    echo "Task marked as completed";

    $stmt->close();
    $conn->close();
}