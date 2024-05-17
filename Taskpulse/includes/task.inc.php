<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){

    try{
        
    require_once 'config_session.inc.php';
    require_once 'database.inc.php';
    require_once 'task_model.inc.php';
    require_once 'task_control.inc.php';



    $taskId= $_POST['taskId'];
    $title = $_POST["title"];  
    $ownerId = $_SESSION["userId"];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $description = $_POST['descript'];
    $deadline = isThereDeadline($date,$time);
    $tag = NULL;
    $completed = $_POST['check'];
    echo $title;
    echo $taskId;  
    
    if((isset($_POST['action']))&&$_POST['action'] == 'update'){


    if($taskId == NULL) {
    addTask($pdo, $title, $description, $deadline,   $ownerId,  $tag, $completed);
    
    header("Location: ../tasks.php");
     die();}
    if($taskId != NULL){
    editTask( $pdo,  $title,  $description, $deadline,   $ownerId,  $tag, $completed, $taskId);  
    header("Location: ../tasks.php"); 
    die();
    }
    }else if((isset($_POST['action']))&&$_POST['action'] == 'delete'){
        if($taskId == NULL) {
            header("Location: ../tasks.php"); 
    die();
        }else{

            deleteTask( $pdo, $taskId);
            header("Location: ../tasks.php"); 
            die();
        }
        
        

    }

    
    header("Location: ../tasks.php"); 
    die(); 

}catch(PDOException $e){ 
        die("Query failed: ". $e->getMessage());
        }
}

































