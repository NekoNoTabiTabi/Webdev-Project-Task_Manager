<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){





try{

require_once 'database.inc.php';
require_once 'signup_model.inc.php';
require_once 'signup_control.inc.php';

$username = $_POST["username"];  
$pwd = $_POST["pwd"];
$email = $_POST["email"];

//error Handdlers

$errors = [];

if (isInputEmpty($username,$pwd,$email)){ 
    $errors["emptyInput"] = "Fill in all fields!";
}
if(isEmailValid ($email)){
    $errors["invalidEmail"] = "Invalid email used!";
}
if(isUsernameTaken($pdo, $username)){
    $errors["takenUsername"] = "Username already taken";
}
if(isEmailTaken($pdo, $email)){
    $errors["takenEmail"] = "Email already taken";
}

require_once 'config_session.inc.php';

if($errors){

    $_SESSION["errorSignup"] = $errors;
    header("Location:../index.php");
    die();
}

 createUser( $pdo, $username, $pwd, $email);
 header("Location:../index.php?signup=success");
 $pdo=null;
 $stmt=null;
 die();

}catch(PDOException $e){
die("Query failed: ". $e->getMessage());
}
}
else{
    header("Location:../index.php");
    die();
}


?>