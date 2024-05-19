<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    require_once 'config_session.inc.php';
    require_once 'database.inc.php';
    require_once 'task_model.inc.php';
    require_once 'task_control.inc.php';


   
   
   $title = $_POST['title'];  
   $ownerId = $_SESSION["userId"];
   $date = $_POST['date'];
   $time = $_POST['time'];
   $description = $_POST['descript'];
   $deadline = isThereDeadline($date,$time);
   $tag = NULL;
   $completed = $_POST['check'];
   $isOnRight = $_POST['isOnRight'];


    try{
        
    

   echo $taskId;
    
    
      if (isset($_POST['action'])) {
          if ($_POST['action'] == 'update') {
              // Edit task
              if ($_POST['taskId'] !== "null") {
                  editTask($pdo, $title, $description, $deadline, $ownerId, $tag, $completed, $isOnRight, $_POST['taskId']);
              } else {
                  // Add task if taskId is null
                  addTask($pdo, $title, $description, $deadline, $ownerId, $tag, $completed, $isOnRight);
              }
              header("Location: ../tasks.php");
              die();
          } else if ($_POST['action'] == 'delete') {
              // Delete task
              if ($_POST['taskId'] !== "null") {
                  deleteTask($pdo, $_POST['taskId']);
              }
              header("Location: ../tasks.php");
              die();
          }
      
         }



         
            // Edit task
            if ($_POST['taskId'] !== "null") {
                editTask($pdo, $title, $description, $deadline, $ownerId, $tag, $completed, $isOnRight, $_POST['taskId']);
            } else {
                // Add task if taskId is null
                addTask($pdo, $title, $description, $deadline, $ownerId, $tag, $completed, $isOnRight);
            }
            header("Location: ../tasks.php");
            die();
        
    
  

}catch(PDOException $e){ 
        die("Query failed: ". $e->getMessage());
   }
}
