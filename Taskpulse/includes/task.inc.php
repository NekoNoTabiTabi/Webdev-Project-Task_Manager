<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){

    try{
        
    require_once 'config_session.inc.php';
    require_once 'database.inc.php';
    require_once 'task_model.inc.php';
    require_once 'task_control.inc.php';
  
    $title = $_POST["title"];  
    $ownerId = $_SESSION["userId"];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $description = $_POST['descript'];

   $deadline = isThereDeadline($date,$time);

    $tag = NULL;
    //$completed = $_POST['check'];
    addTask( $pdo,  $title,  $description, $deadline,   $ownerId,  $tag);
    $saveTasks = getTasks($pdo);

 header("Location: ../tasks.php");
 die();

}catch(PDOException $e){ 
        die("Query failed: ". $e->getMessage());
        }
}

































?>