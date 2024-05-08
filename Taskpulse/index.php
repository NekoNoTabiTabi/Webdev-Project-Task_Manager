<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <title>TaskPulse</title>
</head>
<body>
    
    <header>
        <h2 class="logo"><img src="images/Logo final.png" width="100" height="100" alt="logo"></h2>
        <nav class="nav-links">
            <a href="LoginPage.html">Home</a>
            <a href="dashboard.html">Dashboard</a>
            <a href="FeedbackPage.html">Feedback</a>
            <button class="loginbtn">Login</button>
        </nav>
    </header>

    <section class="home">
    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close"></ion-icon></span>
        <div class="form-box login">
            <h2> Login</h2>
 
 
                                       <!--  log in   -->

            <form action="includes/login.inc.php" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="username" name="username" placeholder="Username">
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="pwd" placeholder= "Password">
                    <label>Password</label>
                </div>
               <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="login-register">
                    <p>Don't have an account?<a href="#" class="register-link"> Register here</a></p>
                </div>
            </form>
        </div>

                                     <!--  sign up  -->
        <div class="form-box register">
            <h2> Register</h2>
            <form action="includes/signup.inc.php" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="username" name="username" placeholder="Username">
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" placeholder="Email">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="pwd" placeholder= "Password">
                    <label>Password</label>
                </div>
               <div class="remember-forgot">
                    <label><input type="checkbox">Agree to the terms and conditions </label>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>Already have an account?<a href="#" class="login-link"> Login</a></p>
                </div>
                <?php
                checkSignupErrors();
        
              ?>
            </form>
       
        </div>
    </div>



    <div class="title">
        <h1>TaskPulse:</h1>
        <h2>Your Buddy To Boosted Productivity!</h2>
        <p> Stay on top of your tasks and supercharge your <br>
            productivity with TaskPulse - your ultimate <br>
            companion for streamlined task management.</p>
    </div>
    <div class="features">
            <p>Features</p>
    </div>

</section>



<section class="features-2">
    <div class="f-list">
        <h1><ion-icon name="trending-up"></ion-icon></h1>
        <h4> Increase Productivity</h4>
        <p>Unleash your full potential and skyrocket your efficiency with our revolutionary productivity-enhancing tools.</p>
    </div>
    <div class="f-list">
        <h1><ion-icon name="time"></ion-icon></h1>
        <h4> Track Your Deadlines</h4>
        <p>Never miss a beat! Stay ahead of your deadlines effortlessly, ensuring every task is completed right on time.</p>
    </div>
    <div class="f-list">
        <h1><ion-icon name="analytics"></ion-icon></h1>
        <h4> Check Your Progress</h4>
        <p>Visualize your success! Dive deep into detailed analytics to monitor your progress and celebrate your achievements.</p>
    </div>
    <div class="f-list">
        <h1><ion-icon name="attach"></ion-icon></h1>
        <h4> Schedule Tasks</h4>
        <p>Stay organized and in control! Effortlessly manage your schedule with intuitive task scheduling features, making every day a breeze.</p>
    </div>
</section>

<footer class="footer">
    <div class="mail-box">
        <div class="mail-left">
            <h3>Contact Us</h3>
                <p>Have questions, feedback, or just want to say hello? <br>
                    We'd love to hear from you! Drop us a message, and we'll <br>
                    get back to you as soon as possible. </p>
            <p><i class="fa-solid fa-phone"></i> Contact Number: 0912-345-6789</p>
            <h1>TaskPulse</h1>
            <p>Copyright <i class="fa-regular fa-copyright"></i> All Rights Reserved.</p>
        </div>
    </div>
</footer>



    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>