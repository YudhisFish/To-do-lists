<?php

include 'dbs.php';

// proses insert data
if(isset($_POST['add'])){

    $q_insert = "INSERT into tasks (tasklabel, taskstatus) value (
    '".$_POST['task']."',
    'open'
    )";
    $run_q_insert = mysqli_query($con, $q_insert);

    if($run_q_insert){
        header('Refresh:0; url=index.php');
    }

}

// proses show data
$q_select = "SELECT * from tasks order by taskid desc";
$run_q_select = mysqli_query($con, $q_select);

// proses delete data
if(isset($_GET['delete'])){

    $q_delete = "DELETE from tasks where taskid = '".$_GET['delete']."' ";
    $run_q_delete = mysqli_query($con, $q_delete);

    header('Refresh:0; url=index.php');

}

// proses update data (close or open)
if(isset($_GET['done'])){
    $status = 'Close';

    if($_GET['status'] == 'Open'){
        $status = 'close';
    }else{
        $status = 'Open';
    }

    $q_update = "UPDATE tasks set taskstatus = '".$status."' where taskid = '".$_GET['done']."' ";
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
                <i class='bx bx-sun'></i>
                <span>To Do List</span>
            </div>

            <div class="description">
                <?= date("l, d M Y") ?>
            </div>
        </div>

        <div class="content">

            <div class="card">
                <form action="" method="post">

                    <input type="text" name="task" class="input-control" placeholder="Add task" required autofocus>

                    <div class="text-right">
                        <button type="submit" name="add">Add</button>
                    </div>

                </form>
            </div>

            <?php
            if(mysqli_num_rows($run_q_select) > 0){
                while($r = mysqli_fetch_array($run_q_select)){
            ?>
            <div class="card">
                <div class="task-item <?= $r['taskstatus'] == 'Close' ? 'done':'' ?>">

                    <div>

                        <input type="checkbox" onclick="window.location.href = '?done=<?= $r['taskid'] ?>&status=<?= $r['taskstatus'] ?>'" <?= $r['taskstatus'] == 'Close' ? 'checked':'' ?>>

                        <span><?= $r['tasklabel'] ?></span>
                        
                    </div>

                    <div>

                        <a href="edit.php?id=<?= $r['taskid'] ?>" class="text-edit" title="Edit"><i class="bx bx-edit"></i></a>

                        <a href="?delete=<?= $r['taskid'] ?>" class="text-delete" title="Remove" onclick="return confirm('Are you sure?')"><i class="bx bx-trash"></i></a>

                    </div>

                </div>
            </div>
            <?php }} else { ?>
                <div>Belum ada task</div>
            <?php } ?>

        </div>

    </div>
</body>
</html>