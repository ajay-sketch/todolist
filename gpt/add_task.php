<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task'];

    // Check for duplicates
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE task = ?");
    $stmt->bind_param("s", $task);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Duplicate task";
    } else {
        $stmt = $conn->prepare("INSERT INTO tasks (task) VALUES (?)");
        $stmt->bind_param("s", $task);
        $stmt->execute();
        echo "Task added";
    }

    $stmt->close();
    $conn->close();
}
