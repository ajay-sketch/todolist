<?php
include('connection.php');

if (isset($_POST['task'])) {
    $task_name = $_POST['task'];

    $check_sql = "SELECT * FROM to_do_list WHERE task = '$task_name'";
    $check_query = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_query) > 0) {
        echo "<div class='alert alert-danger'>Duplicate Task!!</div>";
    } else {
        $sql = "INSERT INTO to_do_list (task, status) VALUES ('$task_name', 0)";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "<div class='alert alert-success'>Task Added Successfully!!</div>";
        } else {
            echo "<div class='alert alert-danger'>Unable to add Task!!</div>";
        }
    }
}
