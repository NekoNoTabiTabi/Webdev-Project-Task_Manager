<?php

//initializing variable
$host = "localhost";
$username = "root";
$password = "";
$dbname = "taskpulse";

//setting up connection
try{
$pdo = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
}catch(PDOException $e){
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);      
    die("Connecetion failed: " . $e->getMessage());
}











?>