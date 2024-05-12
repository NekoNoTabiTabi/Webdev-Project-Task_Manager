<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){

    $title= $_POST[""];  
    $pwd = $_POST[""];
    $ownerId = $_SESSION['userId'];

    require_once 'database.inc.php';
    require_once 'task_model.inc.php';
    require_once 'task_control.inc.php';







}






























?>