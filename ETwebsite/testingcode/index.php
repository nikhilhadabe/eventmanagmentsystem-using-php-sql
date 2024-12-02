<?php
require('connection.php');
session_start();


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ETweb</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1> DNYANI EVENT</h1>
        <nav>
            <a href="#">HOme</a>
            <a href="#">Blog</a>
            <a href="#">Contact</a>
            <a href="#">About</a>
        </nav>

        <?php

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            //echo"loggedin";
            echo "
              <div class='user'>
              $_SESSION[username] - <a href='logout.php'>LOGOUT </a>
              </div> 
              ";
        } else {
            echo "
               <div class='sign-in-up'>
               <button type='button' onclick=\"popup('loginpopup')\">Login</button>
             <button type='button' onclick=\"popup('registerpopup')\">register</button>
               </div>
              ";
        }




        ?>

        <!--  <div class="sign-in-up">
            <button type="button" onclick="popup('loginpopup')">Login</button>
            <button type="button" onclick="popup('registerpopup')">register</button>
        </div>-->
    </header>



    <div class="popup-container" id="loginpopup">
        <div class="popup">
            <form action="loginregister.php" method="POST">
                <h2>
                    <span>User Login</span>
                    <button type="reset" onclick="popup('loginpopup')">X</button>

                </h2>
                <input type="text" placeholder="E-mail or username" name="emailusername"><br>
                <input type="password" placeholder="Password" name="password"><br>
                <button type="submit" class="login-btn" name="login">Login</button>
            </form>
            <div class="forgot-btn">
               
                    <button type="button" onclick="forgotpopup()">Forgot Password</button>
            </div>
        </div>
    </div>



    <div class="popup-container" id="registerpopup">
        <div class=" register popup">
            <form action="loginregister.php" method="POST">
                <h2>
                    <span>User Register</span>
                    <button type="reset" onclick="popup('registerpopup')"> X</button>

                </h2>
                <input type="text" placeholder="Full Name" name="fullname"><br>
                <input type="text" placeholder="username" name="username"><br>
                <input type="email" placeholder="email" name="email"><br>
                <input type="password" placeholder="Password" name="password"><br>
                <button type="submit" class="register-btn" name="register">Register</button>
            </form>
        </div>
    </div>

    <div class="popup-container" id="forgot-popup">
        <div class="forgot popup">
            <form action="forgotpassword.php" method="POST">
                <h2>
                    <span>Reset Password? </span>
                    <button type="reset" onclick="popup('forgot-popup')">X</button>
                    <!--<button type="reset" onclick="popup('forgot-popup')">X</button>  -->


                </h2>
                <input type="email" placeholder="E-mail" name="email"><br>
                <button type="submit" class="login-btn" name="sendresetlink">Send Link</button>
            </form>
        </div>
    </div>


    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo "<h1 style='text-align: center; margin-top: 200px;'> Welcome to this website - $_SESSION[username] </h1>";
    }


    ?>

    <script>
        function popup(popupname) {
            getpopup = document.getElementById(popupname);
            if (getpopup.style.display == "flex") {
                getpopup.style.display = "none";
            }
            else {
                getpopup.style.display = "flex";
            }

        }


        function forgotpopup() {
            document.getElementById('loginpopup').style.display="none";
            document.getElementById('forgot-popup').style.display="flex";
        }
    </script>
</body>

</html>