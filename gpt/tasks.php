<?php
include 'db.php';

$result = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");

$tasks = array();
while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

echo json_encode($tasks);

$conn->close();
