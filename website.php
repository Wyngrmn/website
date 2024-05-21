Wayne German
<?php
session_start();

// Initialize todo list
$todoList = isset($_SESSION["todoList"]) ? $_SESSION["todoList"] : [];

// Function to append data to todo list
function appendData($data) {
    return $data;
}

// Function to delete data from todo list
function deleteData($toDelete, &$todoList) {
    $index = array_search($toDelete, $todoList);
    if ($index !== false) {
        array_splice($todoList, $index, 1);
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["task"])) {
        echo '<script>alert("Error: there is no data to add in array")</script>';
    } else {
        $task = $_POST["task"];
        $todoList[] = appendData($task);
        $_SESSION["todoList"] = $todoList;
    }
}

// Process task deletion
if (isset($_GET['task'])) {
    deleteData($_GET['task'], $todoList);
    $_SESSION["todoList"] = $todoList;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple To-Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .task-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }
        .task-item:last-child {
            border-bottom: none;
        }
        .delete-btn {
            padding: 5px 10px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">To-Do List</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" name="task" placeholder="Enter your task here">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Add Task</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Tasks</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                    <?php foreach ($todoList as $task) : ?>
                        <li class="list-group-item task-item">
                            <span><?= $task ?></span>
                            <form action="" method="GET" class="ml-auto">
                                <button type="submit" name="task" value="<?= $task ?>" class="btn btn-danger delete-btn">Delete</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>