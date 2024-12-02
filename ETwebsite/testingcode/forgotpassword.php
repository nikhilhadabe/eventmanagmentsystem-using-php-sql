<?php 
require("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$resettoken)
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
    $mail->Subject = 'Password Reset link from Nikhil Hadabe';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->Body = "We got a request from you to reset your password<br>
                 Click the link below:<br>     
                 <a href='http://localhost/loginreisterform/updatepassword.php?email=$email&resettoken=$resettoken'>Reset Password</a>
      
                        
                         ";


    $mail->send();
    //echo 'Message has been sent';
    return true;
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return false;
}

}





if(isset($_POST['sendresetlink']))
{
    $query="SELECT * FROM `registeruser` WHERE `email`='$_POST[email]'";
    $result=mysqli_query($con,$query);
    if($result)
    {
        //echo "run";for testing
        if(mysqli_num_rows($result)==1)
        {
            /*email found */
            $resettoken=bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/maharashtra');
            $date=date("Y-m-d");

            $query="UPDATE `registeruser` SET `resettoken`='$resettoken',`resettokenexpired`='$date' WHERE `email`='$_POST[email]'";
            if(mysqli_query($con,$query) && sendMail($_POST['email'],$resettoken))
            {
                echo"
                <script>
                 alert('Password Reset Link Sent to Your Email');
                 window.location.href='index.php';
                 </script>
                 ";

            }
            else
            {
                echo"
               <script>
                alert('Server Down Try Again later');
                window.location.href='index.php';
            
                </script>
                ";

            }

        }
        else
        {
            echo"
            <script>
            alert('Email Not Found');
            window.location.href='index.php';
            
            </script>
            ";
        }

    }
    else
    {
        echo"
        <script>
        alert('cannot run query');
        window.location.href='index.php';
        
        </script>
        ";

    }


}

?>