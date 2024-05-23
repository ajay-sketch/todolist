<?php
include('connection.php');

$sql = "SELECT * FROM to_do_list";
$query = mysqli_query($conn, $sql);
$srno = 1;
while ($row = mysqli_fetch_assoc($query)) {
    $status = $row['status'] == 2 ? '<span style="color:green;">Completed</span>' : '<span style="color:orange;">Pending</span>';
    echo "<tr id='task-{$row['id']}'>
            <td>{$srno}</td>
            <td>{$row['task']}</td>
            <td>{$status}</td>
            <td>" . ($row['status'] != 2 ? "<input type='checkbox' class='mark-completed' data-id='{$row['id']}'>" : "") . "
                <a href='#' class='remove-task' data-id='{$row['id']}'><i class='fa-regular fa-circle-xmark'></i></a></td>
          </tr>";
    $srno++;
}
