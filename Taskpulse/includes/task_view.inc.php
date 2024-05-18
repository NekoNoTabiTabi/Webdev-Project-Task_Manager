<?php












function displayTask(array $saveTasks){
    foreach($saveTasks as $task){
    $deadlineString = $task["deadline"];
     $deadlineArray = explode(" ", $deadlineString);
     $date = $deadlineArray[0];
     $time = $deadlineArray[1];
    

  echo '<form id="createTask" action="includes/task.inc.php" method="post">
        <div class="tasks" draggable="true">
        <div class="task-title">
        <input type="hidden" name="taskId" value='.$task["task_id"].'>
        <input type="text" name="title" placeholder="Task Title" class="task-title" value=' . $task["title"].' required="">
        <div class="datetime"><div class="Date"><label>Date:</label><input type="date" name="date" placeholder="Date" value='.$date.' class="task-details">
        </div>
        <div class="Time"><label>Time:</label>
        <input type="time" name="time" placeholder="Time" value='.$time.' class="task-details">
       </div>
       <input type="hidden" name="check" value="0">';
       if($task["completed"]==0){
       echo '<input type="checkbox" name="check" class="checkbox-styled" value= 1 style="color: rgb(231, 113, 125);">'
       ;}else{ echo '<input type="checkbox" checked name="check" class="checkbox-styled" value= 1 style="color: rgb(231, 113, 125);">';}      
       echo'
       </div>
          </div><textarea name="descript" placeholder= "Description of Task" class="task-description">' . $task["descript"].'</textarea><div class="foot-task">
           <div class="tag"><label>Tag</label><button>
            <i class="fa-solid fa-plus"></i></button></div>
             <div class="tagWrapper">
                </div><div class="task-edit">
                  <button type="submit" name="action" value="update">Save</button><button type="submit" name="action" value="delete">
                    <i class="fa-solid fa-trash">
                       </i></button>
                        </div>
                          </div>
                            </div>
                              </form>'  
   ;}
}