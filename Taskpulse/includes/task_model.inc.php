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
function addTask(object $pdo, string $title, NULL|string $description, $deadline, string $ownerId, NULL|string $tag) {

    $query = "INSERT INTO tasks (title, descript, deadline, owner_id, tag) VALUES (:title, :descript, :deadline, :owner_id, :tag)";
    $stmt = $pdo->prepare($query);
    $stmt -> bindParam(":title", $title);
    $stmt -> bindParam(":descript", $description);
    $stmt -> bindParam(":deadline", $deadline);
    $stmt -> bindParam(":owner_id", $ownerId);   
    $stmt -> bindParam(":tag", $tag);

    $stmt-> execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}



function editTask(object $pdo , string $title, NULL|string $description, $deadline, string $ownerId, NULL|string $tag) {

    $query = "INSERT INTO tasks (title, descript, deadline, owner_id, tag) VALUES (:title, :descript, :deadline, :owner_id, :tag)";
    $stmt = $pdo->prepare($query);
    $stmt -> bindParam(":title", $title);
    $stmt -> bindParam(":descript", $description);
    $stmt -> bindParam(":deadline", $deadline);
    $stmt -> bindParam(":owner_id", $ownerId);   
    $stmt -> bindParam(":tag", $tag);
    $stmt -> execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}



function getTasks(object $pdo) {
    $saveTasks= [];
    $ownerId = $_SESSION["userId"];
    $sql = "SELECT * FROM tasks WHERE owner_id = $ownerId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        while ($row =  $stmt->fetch(PDO::FETCH_ASSOC)) {
            $saveTasks[] = $row;
        }
    }
    return $saveTasks;
}
