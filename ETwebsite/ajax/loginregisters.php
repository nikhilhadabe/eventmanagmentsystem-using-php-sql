<?php

require('../admin/inc/dbconfig.php'); //Emmet path abbrevation ../
require('../admin/inc/essentials.php');
require('../inc/phpmailer/mail.php');

require '../inc/phpmailer/phpmailer/PHPMailer.php';
require '../inc/phpmailer/phpmailer/SMTP.php';
require '../inc/phpmailer/phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/*
function sendMail($mail,$name)
{
  

$mail = new PHPMailer(true);

try {
    //Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'hadabenikhil@gmail.com';                     //SMTP username
    $mail->Password   = 'haht jdyt phrd qyna';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('hadabenikhil@gmail.com', 'DnyaniEvent');

    $mail->addAddress($mail,$name);     //Add a recipient
    
    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
  //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Account Verification Link';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    echo 'Message has been sent';
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
*/
/*
function sendMail($email, $Name,$token)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'hadabenikhil@gmail.com';               //SMTP username
        $mail->Password   = 'haht jdyt phrd qyna';                  //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to

        //Recipients
        $mail->setFrom('hadabenikhil@gmail.com', 'DnyaniEvent');
        $mail->addAddress($email, $Name);         //Add a recipient

        //Content
        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = 'Account Verification Link';
       // $mail->Body = 'Click the link to confirm your email<br><a href='".SITE_URL."emailconfirm.php?email=$mail"."'>Click Me</a>';
       $mail->Body = 'Click the link to confirm your email<br><a href="'.SITE_URL.'emailconfirm.php?email=$mail$token=$token"." ">Click Me</a>';



        //This is the HTML message body <b>in bold!</b> $mail->Body 
        
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


        $mail->send();

        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

*/

/*
if(isset($_POST['register']))
{
    $data= filteration($_POST);

    //match password and confirm password

    if($data['pass']!= $data['cpass'])
    {
        echo 'pass-MisMatch';
        exit;
    }
    //check user exits or not

    $uexist=select("SELECT * FROM `usercred` WHERE `email`=? AND `pnum`=? LIMIT 1 ",
                   [$data['email'],$data['pnum']],"ss");

         if(mysqli_num_rows($uexist)!=0){
            $uexistfetch = mysqli_fetch_assoc($uexist);
            echo ($uexistfetch['email']==$data['email']) ? 'email_already' : 'Phone_already';
            exit;
         }       
         
      //upload user image to server
      
      $img=uploadUserImage($_FILES['profile']);

      if($img =='inv_img')
      {
        echo 'inv_img';
        exit;
      }
      else if($img =='upd_failed'){
        echo 'upd_failed';
        exit;
      }

      //email cofirmation  link to user's email  use= sendgrid SMTP

     // $token =bin2hex( random_bytes(16));
    //  sendMail($data['email'],$data['name'],$token);
       $token =bin2hex( random_bytes(16));
        if( sendMail($data['email'],$data['name'],$token)){
          echo 'mail_failed';
          exit;
        }

     $encpass=password_hash($data['pass'],PASSWORD_BCRYPT);

     $query="INSERT INTO `usercred`( `name`, `email`, `address`, `pnum`, `pincode`, `dob`, 
      `profile`, `password`, `token`,) VALUES ('?,?,?,?,?,?,?,?,?')";
      $values= [$data['name'],$data['email'],$data['address'],$data['pnum'],$data['pincode'],$data['dob'],
      $data['token'],$img,$encpass,$token];

      if(insert($query,$values,'sssssssss')){
        echo 'ins_failed';
      }
      

}
*/
function sendMail($email, $name, $token)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'hadabenikhil@gmail.com';               // SMTP username
        $mail->Password   = 'haht jdyt phrd qyna';                  // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable implicit TLS encryption
        $mail->Port       = 587;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('hadabenikhil@gmail.com', 'DnyaniEvent');
        $mail->addAddress($email, $name);                           // Add a recipient

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Account Verification Link';
      //  $mail->Body = 'Click the link to confirm your email<br><a href="' . SITE_URL . 'emailconfirm.php?email=' . $email . '&token=' . $token . '">Click Me</a>';
      $mail->Body = 'Click the link to confirm your email<br><a href="' . SITE_URL . 'emailconfirm.php?email=' .['email'] . '&token=' . $token . '">Click Me</a>';


        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}

// Uncomment the following line if you want to generate a token for email verification
// $token = bin2hex(random_bytes(16));

if (isset($_POST['register']))
 {
    $data = filteration($_POST);

    // Match password and confirm password
    if ($data['pass'] != $data['cpass']) {
        echo 'pass-MisMatch';
        exit;
    }

    // Check if user exists or not 
    $uexist = select("SELECT * FROM `usercred` WHERE `email`=? AND `pnum`=? LIMIT 1 ", [$data['email'], $data['pnum']], "ss");

    if (mysqli_num_rows($uexist) != 0) {
        $uexistfetch = mysqli_fetch_assoc($uexist);
        echo ($uexistfetch['email'] == $data['email']) ? 'email_already' : 'Phone_already';
        exit;
    }

    // Upload user image to server
    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    } else if ($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
    }

    // Email confirmation link to user's email
    
    $token = bin2hex(random_bytes(16));
    if (!sendMail($data['email'], $data['name'], $token)) {
        echo 'mail_failed';
        exit;
    }

    $encpass = password_hash($data['pass'], PASSWORD_BCRYPT);
    $query = "INSERT INTO `usercred`(`name`, `email`, `address`, `pnum`, `pincode`, `dob`, `profile`, `password`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";

    $values = [$data['name'], $data['email'], $data['address'], $data['pnum'], $data['pincode'], $data['dob'], $img, $encpass, $token];

    if (!insert($query, $values, 'sssssssss')) {
        echo 'ins_failed';
    }
}





?>