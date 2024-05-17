<?php
function isThereDeadline(string $date, string $time){
   
    if($date==NULL&&$time==NULL){
     $deadline = "0000-00-00 00:00:00";    
     return $deadline;

    }else if($date!=NULL&&$time==NULL){
     return $date;
    }
    else if($date==NULL&&$time!=NULL){
     return $time;  
    }
    $deadline = $date  ." ". $time;
    return $deadline;
    }




