<?php
declare(strict_types=1);

function checkLoginErrors(){
    if(isset($_SESSION["errorLogin"])){
    $errors = $_SESSION["errorLogin"];
    
    echo "<br>";

    foreach( $errors as $error){
        echo '<p >'. $error . '</p>';
        }
      

    unset($_SESSION["errorLogin"]);
    }
    
    else if(isset($_GET["login"]) && $_GET["login"] === "success")
    {
    
      echo '<br>';
      echo '<p > success </p>';
    
    }

}

 function outputLogoutButton(){
   if(isset($_SESSION['userId'])){
    
  
 ;}
}