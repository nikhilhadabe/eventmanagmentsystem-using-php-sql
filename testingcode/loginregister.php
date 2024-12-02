<?php

require('connection.php');
session_start();         //it helps to access variable at multiplepage &include
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;







function sendMail($email, $vcode)
{
    //Load Composer's autoloader
    require 'phpmailer/phpmailer/Exception.php';
    require 'phpmailer/phpmailer/PHPMailer.php';
    require 'phpmailer/phpmailer/SMTP.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);


    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'hadabenikhil@gmail.com';                     //SMTP username
        $mail->Password = 'haht jdyt phrd qyna';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('hadabenikhil@gmail.com', 'Nikhil Hadabe');         //setfrom means who is sender
        $mail->addAddress($email);     //Add a recipient  addaddress means kisko bejna hai

        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email Verfication from Nikhil Hadabe';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->Body = "Thanks for registration!
                     Click the link below to verify the email address <br>     
                     <a href='http://localhost/loginreisterform/verify.php?email=$email&vcode=$vcode'> VerfiyEmail</a>
          
                            
                             ";


        $mail->send();
        //echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }



}




//<a href='http://localhost/loginregisterform/verify.php?email=$email&vcode=$vcode'> VerfiyEmail</a>






//login form user
if (isset($_POST['login'])) {
    $query = "SELECT * FROM `registeruser` WHERE `email`='$_POST[emailusername]' OR `username`='$_POST[emailusername]' ";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) 
        {
            $resultfetch = mysqli_fetch_assoc($result);
            if ($resultfetch['isverified'] == 1) 
            {

                if (password_verify($_POST['password'], $resultfetch['password'])) //passowrd with blowfish encryption checked matched or not
                {
                    //if password matched
                    //session use and reload if it is matched indexpage
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $resultfetch['username'];
                    header("location: index.php");


                } 
                else {
                    //if incorrect password
                    echo "
                 <script>
                  alert('Incorrect Password');
                 window.location.href='index.php';
                 </script>
               ";
                }

            }
             else {
                 echo "
                  <script>
                    alert('Email NOt verified');
                    window.location.href='index.php';
                  </script>
                    ";

            }


        } 
        else {
            echo "
        <script>
        alert('Email or Username Not registered');
        window.location.href='index.php';
        </script>
        ";
        }

    } 
    else {
        echo "
    <script>
    alert('Cannot Run Query');
    window.location.href='index.php';
    </script>
    ";

    }

}


//register form user
if (isset($_POST['register'])) {

    $userexistquery = "SELECT * FROM `registeruser` WHERE `username`='{$_POST['username']}' OR `email`='{$_POST['email']}' ";
    $result = mysqli_query($con, $userexistquery);

    if ($result) {
        if (mysqli_num_rows($result) > 0) //it will be executed if username or email is already taken
        {
            //if any user has already taken username or email
            $resultfetch = mysqli_fetch_assoc($result);
            if ($resultfetch['username'] == $_POST['username']) {
                //error for username already registered
                echo "
                 <script>
                 alert(' $resultfetch[username] -Username already taken');
                 window.location.href='index.php';
                 </script>
                ";

            } else {
                //error for email already registered
                echo "
                 <script>
                 alert(' $resultfetch[email] -email already registered');
                 window.location.href='index.php';
                 </script>
                ";
            }

        } else {
            //it will be executed if no one has taken username or email before

            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);   //blowfishAlgorithm

            //  echo random_bytes(16);   // generate random
            $vcode = bin2hex(random_bytes(16));     //binary to hex

            $query = "INSERT INTO `registeruser`(`fullname`, `username`, `email`, `password`,`verificationcode`, `isverified`)
             VALUES ('{$_POST['fullname']}','{$_POST['username']}','{$_POST['email']}','$password','$vcode','0')";

            if (mysqli_query($con, $query) && sendMail($_POST['email'], $vcode))  //call sendMail function & pass parameter $email or $vcode
            {
                //if data inserted successfully
                echo "
                <script>
                alert('Registration Successfully');
                window.location.href='index.php';
                </script>
                ";


            } else {
                //if data cannot be inserted
                echo "
                <script>
                alert('Server Down!');
                window.location.href='index.php';
                </script>
                ";

            }

        }
    } else {
        echo "
       <script>
       alert('Cannot Run Query');
       window.location.href='index.php';
       </script>
       ";
    }

}

?>