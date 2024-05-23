<?php
include('connection.php');

$sql = "SELECT * FROM to_do_list";
$query = mysqli_query($conn, $sql);
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title></title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h3 class="text-info mt-4">PHP - Simple To Do List App</h3>
                <hr>
                <form action="add_task.php" method="post">
                    <label for="Task">Enter Task Below</label>
                    <input type="text" name="task" placeholder="Enter Task" class="form-control">
                    <button type="submit" name="submit" class="mt-3 btn btn-primary">Add Task</button>
                    <?php if (isset($msg)) {
                        echo $msg;
                    } ?>
                </form>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task</th>
                            <th>Status</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $srno = 1;
                        while ($row = mysqli_fetch_assoc($query)) {
                            if ($row['status'] == 0) {
                                $status = '<span style="color:orange;">Pending</span>';
                            } elseif ($row['status'] == 1) {
                                $status = '<span style="color:green;">Success</span>';
                            } else {
                                $status = '<span style="color:red;">Unsuccessful</span>';
                            }
                        ?>

                            <tr>
                                <td><?php echo $srno; ?></td>
                                <td><?php echo $row['task']; ?></td>
                                <td><?php echo $status; ?></td>
                                <td><a href=""><i class="fa-regular fa-pen-to-square"></i></a></td>
                                <td><a href="remove_task.php?id=<?php echo $row['id']; ?>" id="remove"><i class="fa-regular fa-circle-xmark"></i></a></td>
                            </tr>
                        <?php
                            $srno++;
                        } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>

    </script>
</body>

</html>