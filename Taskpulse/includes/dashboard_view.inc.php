<?php




function displayTask(array $saveTasks){
foreach ($saveTasks as $task){
 echo   '<div class="task-items">
        <h3>'.$task['title'].'</h3>
        <div class="duedate">
            <i class="fa-solid fa-calendar-xmark"></i>
            <p>'.$task['deadline'].'</p>
        </div>
    </div>';
}
}


