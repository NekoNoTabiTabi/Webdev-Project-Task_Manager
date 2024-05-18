<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/database.inc.php';
require_once 'includes/task_model.inc.php';
require_once 'includes/task_control.inc.php';
require_once 'includes/task_view.inc.php';

if(!isset($_SESSION["userId"])){
    header('Location: ./index.php');
    die();
}

$saveTasks = getTasks($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!------added stylesheets for responsiveness------>
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="responsive2.css">
    <!------------------------------------------------>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <title>TaskPulse</title>

</head>

<body>

<section class="dashboard"> 
    <div class="search-bar">
        <img id="logo" src="images/Logo final.png" width="100" height="100" alt="logo">
        <div class="user">
         <?php
            echo '<h1>' . $_SESSION['userUsername'] . '</h1>'
              ?>
            <img src="images/avatar.jpg">
            
        </div>
    </div>

     <!--- responsiveness----->
     <div class="menu-header">
        <img id="board-logo" src="images/Logo final.png" width="100" height="100" alt="logo">
        <div class="menu-user">
        <?php
            echo '<h1>' . $_SESSION['userUsername'] . '</h1>'
              ?>
            <img src="images/avatar.jpg">
            
         </div>
     </div>

     <div class="board-side-menu">
         <nav class="board-side-links">
             <a href="index.php">Home</a>
                <a href="dashboard.php">Dashboard</a>
                <a href="tasks.php">Tasks</a>
                <a href="calendar.php">Calendar</a>

         </nav>
     </div>
     <!-----------ends here-------------------->
    <div class="board">
        <div class="board-left">
                 <a href="index.php">Home</a>
                 <a href="dashboard.php">Dashboard</a>
                 <a href="tasks.php">Tasks</a>
                 <a href="calendar.php">Calendar</a>

            <section class="graph">
                <div class="progressgraph">
                    <canvas id="ProgressChart" width="100" height="100"></canvas>
                </div>
            </section>
        </div>
        <div class="board-wrapper">
            <div class="taskboard-right">
                <div class="board-header">
                    <h1>Tasks Today</h1>
                    <button class="addtask"><i class="fa-solid fa-plus"></i></button>
                </div>
                <div class="taskwrapper">
                
                 <?php
                    echo displayTask($saveTasks);                                    
                    ?>

                </div>
                </div>
            </div>
            <!---deadline section----->
            <div class="taskboard-right-right">
                <div class="board-header">
                    <h1>Future Tasks</h1>
                </div>
                <div class="taskwrapper-right">


                    <?php
                                                        
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>


<!---script for creating tasks------>
<script>

   

    const addTaskButton = document.querySelector('.addtask');
    const taskWrap = document.querySelector('.taskwrapper');

    function removeTask(taskElement) {
    taskElement.remove();
}

    // taskWrap.addEventListener('click', (event) => {
    //     if (event.target.matches('.fa-trash')) {
    //         const trashButton = event.target;
    //         const taskElement = trashButton.closest('.tasks');
    //         if (taskElement) {
    //             removeTask(taskElement);
    //         }
    //     }
    // });

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

        const addTaskForm = document.createElement('form');
        addTaskForm.id = 'createTask';
        addTaskForm.action = "includes/task.inc.php";
        addTaskForm.method = 'post';

        
        const taskDiv = document.createElement('div');
        taskDiv.classList.add('tasks');
        enableDragAndDropForTask(taskDiv);
        taskWrap.appendChild(taskDiv); 

        const headTaskDiv = document.createElement('div');
        headTaskDiv.classList.add('task-title');
        
   // TaskId
        const taskId = document.createElement('input');
        taskId.type = 'hidden';
        taskId.name = 'taskId';
        taskId.value = 'null';

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
        dateInput.name = 'date';
        dateInput.placeholder = 'Date';
        dateInput.classList.add('task-details');
        dateInput.required = false;

        const timeDiv = document.createElement('div');
        timeDiv.classList.add('Time');
        const timeLabel = document.createElement('label');
        timeLabel.textContent = 'Time:';

        const timeInput = document.createElement('input');
        timeInput.type = 'time';
        timeInput.name = 'time';
        timeInput.placeholder = 'Time';
        timeInput.classList.add('task-details');
        timeInput.required = false;

        const unCheckBox = document.createElement('input');
        unCheckBox.type = 'hidden';
        unCheckBox.value = '0';
        unCheckBox.name = 'check';
 
        const checkBox = document.createElement('input');
        checkBox.type = 'checkbox';
        checkBox.name = 'check';
        checkBox.value = '1';
        checkBox.classList.add('checkbox-styled');
        checkBox.style.color = '#E7717D';

        const descriptionTextarea = document.createElement('textarea');
        descriptionTextarea.name = 'descript';
        descriptionTextarea.placeholder = 'Description of Task';
        descriptionTextarea.classList.add('task-description');
        descriptionTextarea.required = false;

        const footTaskDiv = document.createElement('div');
        footTaskDiv.classList.add('foot-task');
        
        const tagDiv = document.createElement('div');
        tagDiv.classList.add('tag');
        const tagLabel = document.createElement('label');
        tagLabel.textContent = 'Tag';

        
        const addTagButton = document.createElement('button');
        addTagButton.innerHTML = '<i class="fa-solid fa-plus"></i>';

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
        const saveButton = document.createElement('button');
        saveButton.textContent = 'Save';
        saveButton.type = 'submit';
        saveButton.value = 'update';
        saveButton.name = 'action';
        trashButton.innerHTML = '<i class="fa-solid fa-trash"></i>';
        trashButton.type = 'submit';
        trashButton.value = 'delete';
        trashButton.name = 'action';
       
        

        const taskEditDiv = document.createElement('div');
        taskEditDiv.classList.add('task-edit');

        dateDiv.appendChild(dateLabel);
        dateDiv.appendChild(dateInput);

        timeDiv.appendChild(timeLabel);
        timeDiv.appendChild(timeInput);

        datetimeDiv.appendChild(dateDiv);
        datetimeDiv.appendChild(timeDiv);
        datetimeDiv.appendChild(unCheckBox);
        datetimeDiv.appendChild(checkBox);

        headTaskDiv.appendChild(titleInput);
        headTaskDiv.appendChild(datetimeDiv);

        taskEditDiv.appendChild(saveButton);
        taskEditDiv.appendChild(trashButton);
        footTaskDiv.appendChild(tagDiv);
        footTaskDiv.appendChild(tagWrapper);
        footTaskDiv.appendChild(taskEditDiv);
        

        tagDiv.appendChild(tagLabel);
        tagDiv.appendChild(addTagButton);
        taskDiv.appendChild(taskId);
        
        taskDiv.appendChild(headTaskDiv);
        taskDiv.appendChild(descriptionTextarea);
        taskDiv.appendChild(footTaskDiv);
        
        addTaskForm.appendChild(taskDiv);

        taskWrap.prepend(addTaskForm);

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
