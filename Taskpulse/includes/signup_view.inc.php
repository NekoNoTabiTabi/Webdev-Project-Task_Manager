<?php
declare(strict_types=1);

function signupInput() {
                 

  if(isset($_SESSION["dataSignup"]["username"]) && isset($_SESSION["errorSignup"]["takenUsername"])){
    echo '<div class="input-box">
    <span class="icon"><ion-icon name="mail"></ion-icon></span>
    <input type="username" name="username" placeholder="Username" value ="'.$_SESSION["dataSignup"]["username"].'" >
    <label>Username</label> </div>'


  ;}else{
  echo '<div class="input-box">
  <span class="icon"><ion-icon name="mail"></ion-icon></span>
  <input type="username" name="username" placeholder="Username">
  <label>Username</label>
  </div>';}

  


  if(isset($_SESSION["dataSignup"]["email"]) && isset($_SESSION["errorSignup"]["takenEmail"])&& isset($_SESSION["errorSignup"]["invalidEmail"])){

    echo '<div class="input-box">
    <span class="icon"><ion-icon name="mail"></ion-icon></span>
    <input type="email" name="email" placeholder="Email" value ="'.$_SESSION["dataSignup"]["email"].'">
    <label>Email</label>
    </div>'
    
    ;}else{
    
      echo '<div class="input-box">
      <span class="icon"><ion-icon name="mail"></ion-icon></span>
      <input type="email" name="email" placeholder="Email">
      <label>Email</label>
      </div>'
    ;}

    echo'<div class="input-box">
  <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
  <input type="password" name="pwd" placeholder= "Password">
  <label>Password</label>
  </div>';
;}





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