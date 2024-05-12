<?php
declare(strict_types=1);

function markTaskCompleted(object $pdo , $task_id) {
   
    $sql = "UPDATE tasks SET completed = 1 WHERE task_id = $task_id";
    if ($pdo->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
function addTask(object $pdo , $title, $description, $deadline, $ownerId) {
 
    $title = mysqli_real_escape_string($pdo, $title);
    $description = mysqli_real_escape_string($pdo, $description);
    $deadline = mysqli_real_escape_string($pdo, $deadline);
    $ownerId = mysqli_real_escape_string($pdo, $ownerId);

    $sql = "INSERT INTO tasks (title, description, deadline) VALUES ('$title', '$description', '$deadline')";
    if ($pdo->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function getTasks(object $pdo) {
    ;
    $tasks = array();
    $ownerId = $_SESSION["userId"];
    $sql = "SELECT * FROM tasks WHERE owner_id = $ownerId";
    $result = $pdo->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
    }
    return $tasks;
}

