<?php
include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM to_do_list WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        echo "<div class='alert alert-success'>Task Removed</div>";
    } else {
        echo "<div class='alert alert-danger'>Unable to remove the task</div>";
    }
}
