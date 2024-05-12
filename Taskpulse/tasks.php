<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/database.inc.php';
require_once 'includes/task_model.inc.php';
require_once 'includes/task_control.inc.php';

if(!isset($_SESSION["userId"])){
    header('Location: ./index.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <title>TaskPulse</title>
    <link rel="icon" type="image/x-icon" href="images/Logo final.png">
</head>

<body>

<section class="dashboard"> 
    <div class="search-bar">
        <img id="logo" src="images/Logo final.png" width="100" height="100" alt="logo">
        <form>
            <input type="text" placeholder="Search...">
            <button type="submit"><ion-icon name="search"></ion-icon></button>
        </form>
        <div class="user">

          <?php
            echo '<h1>' . $_SESSION['userUsername'] . '</h1>'
              ?>

            <img src="images/avatar.jpg">
        </div>
    </div>
    <div class="board">
        <div class="board-left">
            <a href="index.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="tasks.php">Tasks</a>
            <a href="calendar.php">Calendar</a>
            
            <section class="graph">
                <div class="progressgraph">
                    <canvas id="ProgressChart" width="100" height="100"></canvas>
                    </canvas>
                </div>
            </section>
        </div>
        <div class="board-wrapper">
            <div class="taskboard-right">
                <div class="board-header">
                    <h1> Tasks Today</h1>
                    <button class="addtask"><i class="fa-solid fa-plus"></i></button>
                </div>


         
            <div class="taskwrapper">
             <form> 
                <div class="tasks" draggable="true">
                    <div class="head-task">
                        <input type="text" name="title" placeholder="Task Title" class="task-title" required>
                    </div>
                    <div class="datetime">
                        <div class="Date">
                            <label>Date:</label>
                            <input type="date" name="deadline" placeholder="Date" class="task-details" required>    
                        </div>
                        <div class="Time">
                            <label>Time:</label>
                            <input type="time" name="deadline" placeholder="Time" class="task-details" required>
                        </div>
                    </div>      
                        <textarea name="task-description" placeholder="Description of Task" class="task-description" required></textarea>
                    <div class="foot-task">
                         <div class="tag">
                            <label>Tag</label>
                            <button class="addtag"><i class="fa-solid fa-plus"></i></button>
                        </div> 
                            <div class="task-edit">
                                <button><i class="fa-solid fa-trash"></i></button>
                            </div>
                    </div>
                    <div class="tagWrapper">
                        <input type="text" name="addtag" placeholder="tag people" class="newTagInput">
                        <button class="removeTag"><i class="fa-solid fa-minus"></i></button>
                    </div>
                </div>
             </form>
            </div>
          


        </div>
    </div>

        <!---deadline section----->
        <div class="taskboard-right-right">
            <div class="board-header">
                <h1> Future Tasks</h1>
            </div>
            <div class="taskwrapper-right">

            </div>
        </div>
    </div>
</div>
</section>

<section>
</section>

<!---script for creating tasks------>

<script>

    const tasks = document.querySelectorAll('.tasks');

    function hideTask(taskElement) {
        taskElement.classList.add('hidden');
    }

    function showTask(taskElement) {
        taskElement.classList.remove('hidden');
    }

   
    tasks.forEach(task => {
        hideTask(task);
    });

    const addTaskButton = document.querySelector('.addtask');
    const taskWrap = document.querySelector('.taskwrapper');

    function removeTask(taskElement) {
    taskElement.remove();
}

    taskWrap.addEventListener('click', (event) => {
        if (event.target.matches('.fa-trash')) {
            const trashButton = event.target;
            const taskElement = trashButton.closest('.tasks');
            if (taskElement) {
                removeTask(taskElement);
            }
        }
    });

    function enableDragAndDropForTask(taskElement) {
    taskElement.draggable = true;

    taskElement.addEventListener("dragstart", function (e) {
        console.log('dragstart');
        e.dataTransfer.setData("text/plain", null);
        e.target.classList.add('dragging');
    });

    return taskElement; 
}

    addTaskButton.addEventListener('click', () => {
       
        const form = document.createElement('form');
        form.id = 'createTask';
        form.action = "includes/tasks.inc.php";
        form.method = 'post';
        
        const taskDiv = document.createElement('div');
        taskDiv.classList.add('tasks');
        enableDragAndDropForTask(taskDiv);
        taskWrap.appendChild(taskDiv); 

        const headTaskDiv = document.createElement('div');
        headTaskDiv.classList.add('task-title');
        
        const titleInput = document.createElement('input');
        titleInput.type = 'text';
        titleInput.name = 'title';
        titleInput.placeholder = 'Task Title';
        titleInput.classList.add('task-title');
        titleInput.required = true;
   
        const datetimeDiv = document.createElement('div');
        datetimeDiv.classList.add('datetime');

        const dateDiv = document.createElement("div");
        dateDiv.classList.add('Date');

        const dateLabel = document.createElement("label");
        dateLabel.textContent = 'Date:';

        const dateInput = document.createElement('input');
        dateInput.type = 'date';
        dateInput.name = 'deadline';
        dateInput.placeholder = 'Date';
        dateInput.classList.add('task-details');
        dateInput.required = true;

        const timeDiv = document.createElement('div');
        timeDiv.classList.add('Time');
        const timeLabel = document.createElement('label');
        timeLabel.textContent = 'Time:';

        const timeInput = document.createElement('input');
        timeInput.type = 'time';
        timeInput.name = 'deadline';
        timeInput.placeholder = 'Time';
        timeInput.classList.add('task-details');
        timeInput.required = true;

        const checkBox = document.createElement('input');
        checkBox.type = 'checkbox';
        checkBox.name = 'check';
        checkBox.classList.add('checkbox-styled');
        checkBox.style.color = '#E7717D';

        const descriptionTextarea = document.createElement('textarea');
        descriptionTextarea.name = 'task-description';
        descriptionTextarea.placeholder = 'Description of Task';
        descriptionTextarea.classList.add('task-description');
        

        const footTaskDiv = document.createElement('div');
        footTaskDiv.classList.add('foot-task');
        
        const tagDiv = document.createElement('div');
        tagDiv.classList.add('tag');
        const tagLabel = document.createElement('label');
        tagLabel.textContent = 'Tag';

        
        const addTagButton = document.createElement('button');
        addTagButton.type = 'submit'


        const tagWrapper = document.createElement('div'); 
        tagWrapper.classList.add('tagWrapper'); 

        addTagButton.addEventListener('click', () => {
            const addTag = document.createElement('input');
            addTag.name = 'addtag';
            addTag.placeholder = 'tag others';
            addTag.classList.add('tag');

            const removeTagButton = document.createElement('button');
            removeTagButton.innerHTML = '<i class="fa-solid fa-minus"></i>';
            removeTagButton.classList.add('remove-tag-button');

            const tagContainer = document.createElement('div');
            tagContainer.classList.add('tag-container');
            tagContainer.appendChild(addTag);
            tagContainer.appendChild(removeTagButton);

            tagWrapper.appendChild(tagContainer);
        });

        tagWrapper.addEventListener('click', (event) => {
            if (event.target.matches('.fa-minus')) {
                const removeTag = event.target;
                const tagContainer = removeTag.closest('.tag-container');
                if (tagContainer) {
                    tagContainer.remove();
                }
            }
        });

        const trashButton = document.createElement('button');
        trashButton.innerHTML = '<i class="fa-solid fa-trash"></i>';

       // const submitButton = document.createElement('button');
       // submitButton. = ;

        const taskEditDiv = document.createElement('div');
        taskEditDiv.classList.add('task-edit');

        dateDiv.appendChild(dateLabel);
        dateDiv.appendChild(dateInput);

        timeDiv.appendChild(timeLabel);
        timeDiv.appendChild(timeInput);

        datetimeDiv.appendChild(dateDiv);
        datetimeDiv.appendChild(timeDiv);
        datetimeDiv.appendChild(checkBox);

        headTaskDiv.appendChild(titleInput);
        headTaskDiv.appendChild(datetimeDiv);

        taskEditDiv.appendChild(trashButton);
        taskEditDiv.appendChild(submitButton);
        footTaskDiv.appendChild(tagDiv);
        footTaskDiv.appendChild(tagWrapper);
        footTaskDiv.appendChild(taskEditDiv);
        

        tagDiv.appendChild(tagLabel);
        tagDiv.appendChild(addTagButton);

        taskDiv.appendChild(headTaskDiv);
        taskDiv.appendChild(descriptionTextarea);
        taskDiv.appendChild(footTaskDiv);

        form.appendChild(taskDiv);

        taskWrap.appendChild(form);
       

    });

    const taskwrapperRight = document.querySelector('.taskwrapper-right');
    const taskwrapper = document.querySelector('.taskwrapper');

    taskwrapperRight.addEventListener('click', (event) => {
    if (event.target.matches('.tasks .fa-trash')) {
        const trashButton = event.target;
        const taskElement = trashButton.closest('.tasks');
        if (taskElement) {
            removeTask(taskElement);
        }
    }
    });


    taskwrapperRight.addEventListener('click', (event) => {
    if (event.target.matches('.tasks .fa-submit')) {
        const trashButton = event.target;
        const taskElement = trashButton.closest('.tasks');
        if (taskElement) {
            removeTask(taskElement);
        }
    }
    });


    taskwrapperRight.addEventListener("dragover", function (e) {
        e.preventDefault();
    });

    taskwrapperRight.addEventListener("drop", function (e) {
        e.preventDefault();
        const draggedTask = document.querySelector('.dragging');
        if (draggedTask && draggedTask.parentElement !== this) {
            this.appendChild(draggedTask);
            draggedTask.classList.remove('dragging');
        }
    });

    taskwrapper.addEventListener("dragover", function (e) {
        e.preventDefault();
    });

    taskwrapper.addEventListener("drop", function (e) {
        e.preventDefault();
        const draggedTask = document.querySelector('.dragging');
        if (draggedTask && draggedTask.parentElement !== this) {
            this.appendChild(draggedTask);
            draggedTask.classList.remove('dragging');
        }
    });


   
</script>

<!-- Script for the chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('ProgressChart');
  
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Completed Tasks', 'Tasks'],
        datasets: [{
          label: 'Progress Check',
          data: [12, 19],
          backgroundColor: ["#E7717D" , "#AFD275"],
          borderWidth: 0
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
</script>

<!-- Script for ionicons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
