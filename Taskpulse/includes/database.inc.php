<?php

//initializing variable
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "taskpulse";

//setting up connection
try{
$pdo = new PDO("mysql:host=$host; dbname=$dbname", $dbusername, $dbpassword);
}catch(PDOException $e){
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);      
    die("Connecetion failed: " . $e->getMessage());
}











?>