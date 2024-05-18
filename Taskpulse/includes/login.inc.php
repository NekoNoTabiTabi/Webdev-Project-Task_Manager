<?php


if($_SERVER["REQUEST_METHOD"] === "POST"){

    $username = $_POST["username"];  
    $pwd = $_POST["pwd"];

try{

    require_once 'database.inc.php';
    require_once 'login_model.inc.php';
    require_once 'login_control.inc.php';
 

//error Handdlers

$errors = [];

if (isInputEmpty($username,$pwd)){ 
    $errors["emptyInput"] = "Fill in all fields!";
}

$result = getUser($pdo,$username);


if (isUsernameWrong($result)){ 
    $errors["loginIncorrect"] = "Incorrect login info";
}

if(!isUsernameWrong($result) && isPasswordWrong( $pwd , $result['pwd'])){ 
    $errors["loginIncorrect"] = "Incorect login info";
}


require_once 'config_session.inc.php';

if($errors){

    $_SESSION["errorLogin"] = $errors;

    header("Location:../index.php");
    die();
}


$newSessionId = session_create_id();
$sessionId = $newSessionId."-". $result["id"];
session_id($sessionId);

$_SESSION["userId"] = $result["id"];
$_SESSION["userUsername"] = htmlspecialchars($result["username"]);
$_SESSION["last_regeneration"] = time();

header("Location:../index.php?login=success");
 
 $stmt=null;
 die();




}catch(PDOException $e){ 
    die("Query failed: ". $e->getMessage());
    }












}else{
   header("Location: ../index.php");
   die();
}

?>