<?php
include('connection.php');

$sql = "SELECT * FROM to_do_list ORDER BY id DESC";
$query = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" />
    <title>PHP To Do List</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h3 class="text-info mt-4">PHP - Simple To Do List App</h3>
                <hr>
                <form id="taskForm">
                    <label for="Task">Enter Task Below</label>
                    <input type="text" id="task" name="task" placeholder="Enter Task" class="form-control" required>
                    <button type="submit" class="mt-3 btn btn-primary">Add Task</button>
                    <div id="msg" class="mt-3"></div>
                </form>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="taskTable">
                        <?php
                        $srno = 1;
                        while ($row = mysqli_fetch_assoc($query)) {
                            $status = $row['status'] == 2 ? '<span style="color:green;">Completed</span>' : '<span style="color:orange;">Pending</span>';
                        ?>
                            <tr id="task-<?php echo $row['id']; ?>">
                                <td><?php echo $srno; ?></td>
                                <td><?php echo $row['task']; ?></td>
                                <td>
                                    <?php echo $status; ?>
                                </td>
                                <td>
                                    <?php if ($row['status'] != 2) { ?>
                                        <input type="checkbox" class="mark-completed" data-id="<?php echo $row['id']; ?>">
                                    <?php } ?>
                                    <a href="#" class="remove-task" data-id="<?php echo $row['id']; ?>"><i class="fa-regular fa-circle-xmark"></i></a>
                                </td>
                            </tr>
                        <?php
                            $srno++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#taskForm').on('submit', function(e) {
                e.preventDefault();
                var task = $('#task').val();
                $.ajax({
                    url: 'add_task.php',
                    method: 'POST',
                    data: {
                        task: task
                    },
                    success: function(response) {
                        $('#msg').html(response);
                        $('#task').val('');
                        loadTasks();
                    }
                });
            });

            $(document).on('click', '.remove-task', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                if (confirm('Are you sure you want to remove this task?')) {
                    $.ajax({
                        url: 'remove_task.php',
                        method: 'GET',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $('#msg').html(response);
                            $('#task-' + id).remove();
                        }
                    });
                }
            });

            $(document).on('change', '.mark-completed', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'update_task.php',
                    method: 'POST',
                    data: {
                        id: id,
                        status: 2
                    },
                    success: function(response) {
                        $('#msg').html(response);
                        loadTasks();
                    }
                });
            });

            function loadTasks() {
                $.ajax({
                    url: 'load_tasks.php',
                    method: 'GET',
                    success: function(data) {
                        $('#taskTable').html(data);
                    }
                });
            }
        });
    </script>
</body>

</html>