<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/database.inc.php';
require_once 'includes/task_model.inc.php';
require_once 'includes/task_control.inc.php';
require_once 'includes/dashboard_view.inc.php';  

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <title>TaskPulse</title>
    <link rel="icon" type="image/x-icon" href="images/Logo final.png">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="responsive2.css">
</head>


<body>

<section class="dashboard"> 

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

                <div class="graph">
                    <div class="progressgraph">
                        <canvas id="ProgressChart" width="100" height="100"></canvas>
                        </canvas>
                    </div>
                </div>
        </div>

        <div class="board-right">
            <div class="message">
                <img src="images/Untitled design (2).png">
                <h1> Welcome to TaskPulse!</h1>
                <p> Let's conquer your tasks and transform the day into a powerhouse of productivity.</p>
            </div>

            <div class="workboard">
                <div class="board-right-left">
                    <div class="to-do-header">
                        <h2>TO-DO</h2>
                    </div>
                   <div class="current-tasks">
                        <?php displayTask($saveTasks)?>
                    </div>
                </div>

                <div class="board-right-right">
                    <div class="time">
                        <span id="hrs">00</span>
                        <span>:</span>
                        <span id="min">00</span>
                        <span>:</span>
                        <span id="sec">00</span>
                    </div>
                    <div class="calendar">
                        <div class="calendar-header">
                            <button id="prev">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                        
                            <div class="monthYear" id="monthYear"></div>
                            <button id="next">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                        <div class="days">
                            <div class="day">Sun</div>
                            <div class="day">Mon</div>
                            <div class="day">Tue</div>
                            <div class="day">Wed</div>
                            <div class="day">Thu</div>
                            <div class="day">Fri</div>
                            <div class="day">Sat</div>
                        </div>
                        <div class="dates" id="dates"></div>
                    </div>
                </div>
            </div>
        </div>
</section>

<!----script for time and calendar. Having problem when putting this in external script file. '_'-->
<script>

    let hrs = document.getElementById("hrs");
    let min = document.getElementById("min");
    let sec = document.getElementById("sec");
    
    setInterval(() => {
        let currentTime = new Date();
    
        hrs.innerHTML = (currentTime.getHours() < 10? "0" : "") + currentTime.getHours();
        min.innerHTML = (currentTime.getMinutes() < 10? "0" : "") + currentTime.getMinutes();
        sec.innerHTML = (currentTime.getSeconds() < 10? "0" : "") + currentTime.getSeconds();
    }, 1000);

    const monthYearElement = document.getElementById('monthYear');
    const datesElement = document.getElementById('dates');
    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');

    let currentDate = new Date();

    const updateCalendar = () => {
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();

    const firstDay = new Date(currentYear, currentMonth, 1); // Change here
    const lastDay = new Date(currentYear, currentMonth + 1, 0);
    const totalDays = lastDay.getDate();
    const firstDayIndex = firstDay.getDay();
    const lastDayIndex = lastDay.getDay();

    const monthYearString = currentDate.toLocaleString (
        'default', {month: 'long' ,year: 'numeric'});
    monthYearElement.textContent = monthYearString;

    let datesHTML = '';

    for(let i = firstDayIndex; i > 0; i--){
        const prevDate = new Date(currentYear,currentMonth, 0 - i + 1);
        datesHTML += `<div class="date inactive">${prevDate.getDate()}</div>`;
    }

    for(let i = 1; i <= totalDays; i++){
        const date = new Date(currentYear, currentMonth, i);
        const activeClass = date.toDateString() === new Date().toDateString() ? 'active' : '';
        datesHTML += `<div class="date ${activeClass}">${i}</div>`;
    }

    for(let i = 1; i <= 7 - lastDayIndex; i++){
        const nextDate = new Date(currentYear, currentMonth + 1, i);
        datesHTML += `<div class="date inactive">${nextDate.getDate()}</div>`;
    }

    datesElement.innerHTML = datesHTML;
    }

    prevBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateCalendar();
    })

    nextBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateCalendar();
    })

    updateCalendar();



</script>

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
   
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


</body>
</html>
    

