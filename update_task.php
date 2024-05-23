
<?php
include('connection.php');

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE to_do_list SET status = '$status' WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        echo "<div class='alert alert-success'>Task status updated</div>";
    } else {
        echo "<div class='alert alert-danger'>Unable to update task status</div>";
    }
}
?>

