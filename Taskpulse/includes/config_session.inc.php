<?php

ini_set('session.use_only_cookkies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
'lifetime' => 1800,
'domain' => 'localhost',
'path' => '/',
'secure' => true,
'httponly' => true,
]);

session_start();

if (!isset($_SESSION["last_generation"])){

    regenerateSessionId();

}
else{

$interval = 60*30;
if(time() - $_SESSION["last_generation"]>=$interval){
    regenerateSessionId();
 }

}

function regenerateSessionId(){
    session_regenerate_id();
    $_SESSION["last_regeneration"] = time();
}









?>