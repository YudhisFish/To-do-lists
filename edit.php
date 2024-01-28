<?php

include 'dbs.php';

// select data yang akan diedit
$q_select = "SELECT * from tasks where taskid = '".$_GET['id']."' ";
$run_q_select = mysqli_query($con, $q_select);
$d = mysqli_fetch_object($run_q_select);

// proses edit data
if(isset($_POST['edit'])){

    $q_update = "UPDATE tasks set tasklabel = '".$_POST['task']."' where taskid = '".$_GET['id']."' ";
    $run_q_update = mysqli_query($con, $q_update);

    header('Refresh:0; url=index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do-List</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- https://boxicons.com -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <div class="header">
            <div class="title">
                <a href="index.php"><i class='bx bx-chevron-left'></i></a>
                <span>Back</span>
            </div>

            <div class="description">
                <?= date("l, d M Y") ?>
            </div>
        </div>

        <div class="content">

            <div class="card">
                <form action="" method="post">

                    <input type="text" name="task" class="input-control" placeholder="Edit task" value="<?= $d->tasklabel ?>">

                    <div class="text-right">
                        <button type="submit" name="edit">Edit</button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</body>
</html>