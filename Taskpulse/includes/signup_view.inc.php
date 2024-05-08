<?php
declare(strict_types=1);

function checkSignupErrors(){

if(isset($_SESSION["errorSignup"])){
  $errors= $_SESSION["errorSignup"];
 
  echo   "<br>";
  foreach( $errors as $error){
  echo '<p >'. $error . '</p>';
  }
  unset($_SESSION["errorSignup"]);
}else if(isset($_GET["signup"]) && $_GET["signup"] === "success")
{

  echo '<br>';
  echo '<p > success </p>';
}
}