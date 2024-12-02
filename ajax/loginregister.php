<?php

require('../admin/inc/dbconfig.php');
require('../admin/inc/essentials.php');

date_default_timezone_set("Asia/kolkata");

require('../inc/phpmailer/phpmailer/PHPMailer.php');
require('../inc/phpmailer/phpmailer/SMTP.php');
require('../inc/phpmailer/phpmailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $token , $type)
{

   if($type =="emailconfirmation")
   {
    $page= 'emailconfirm.php';
    $subject ="Account verfication Link";
    $content="confirm your email";
   }
   else
   {
    $page= 'index.php';
    $subject= "Account reset Link";
    $content="reset your account";
   }



    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hadabenikhil@gmail.com';
        $mail->Password = 'haht jdyt phrd qyna';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('hadabenikhil@gmail.com', 'Nikhil Hadabe');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = '$subject';
        $mail->Body = "Thanks for registration!
         Click the link below to $content: <br> 
        <a href='http://localhost/ETwebsite/$page?$type&email=$email&token=$token'> Verify Email</a>";

        $mail->send();
        return 1;
    } catch (Exception $e) {
        return 0;
    }
}

/*
if (isset($_POST['register'])) {
    $data = filteration($_POST);

    if ($data['pass'] != $data['cpass']) {
        echo 'pass-MisMatch';
        exit;
    }

    $uexist = select("SELECT * FROM `usercred` WHERE `email`=? AND `pnum`=? LIMIT 1 ", [$data['email'], $data['pnum']], "ss");

    if (mysqli_num_rows($uexist) != 0) {
        $uexistfetch = mysqli_fetch_assoc($uexist);
        echo ($uexistfetch['email'] == $data['email']) ? 'email_already' : 'Phone_already';
        exit;
    }

    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    } else if ($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
    }

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
*/
/*
if (isset($_POST['register'])) {
    $data = filteration($_POST);

    if ($data['pass'] != $data['cpass']) {
        echo 'pass-MisMatch';
        exit;
    }

    // Check if user exists
    $uexist = select("SELECT * FROM `usercred` WHERE `email`=? OR `pnum`=? LIMIT 1 ", [$data['email'], $data['pnum']], "ss");

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
    } else {
        echo 'registration_success'; // Optional success message
    }
}
*/
if (isset($_POST['register'])) {
    $data = filteration($_POST);

    if ($data['pass'] != $data['cpass']) {
        echo 'pass-MisMatch';
        exit;
    }

    // Check if user exists
    $uexist = select("SELECT * FROM `usercred` WHERE `email`=? OR `pnum`=? LIMIT 1 ", [$data['email'], $data['pnum']], "ss");

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

    //send confirmation link to email
    $token = bin2hex(random_bytes(16));
    if (!sendMail($data['email'], $token,"emailconfirmation")) {
        echo 'mail_failed';
        exit;
    }

    $encpass = password_hash($data['pass'], PASSWORD_BCRYPT);
    $query = "INSERT INTO `usercred`(`name`, `email`, `address`, `pnum`, `pincode`, `dob`, `profile`, `password`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";

    $values = [$data['name'], $data['email'], $data['address'], $data['pnum'], $data['pincode'], $data['dob'], $img, $encpass, $token];

    if (insert($query, $values, 'sssssssss')) {
        echo '1';
    } else {
        echo 'ins_failed'; // Optional success message
    }
}



if (isset($_POST['login']))
{
   $data=filteration($_POST);

   // Check if user exists
    $uexist = select("SELECT * FROM `usercred` WHERE `email`=? OR `pnum`=? LIMIT 1 ", [$data['emailmob'], $data['emailmob']], "ss");

    if (mysqli_num_rows($uexist) == 0) {
        echo 'inv_email_mob';
        exit;
    }
    else{

        $ufetch = mysqli_fetch_assoc($uexist);
        if($ufetch['isverify']==0)
        {
            echo 'not_verified';
        }
        else if($ufetch['status']==0)
        {
           echo 'inactive';
        }
        else
        {
          if(!password_verify($data['pass'],$ufetch['password'])){
            echo 'invalid_pass';
          }
          else{
            session_start();
            $_SESSION['login']=true;
            $_SESSION['uid']=$ufetch['id'];
            $_SESSION['uname']=$ufetch['name'];
            $_SESSION['upic']=$ufetch['picture'];
            $_SESSION['uphone']=$ufetch['pnum'];
            echo 1;

          }
        }
    }
       
    
}



if (isset($_POST['forgotpass']))
{
    $data=filteration($_POST);

    // Check if user exists
    $uexist = select("SELECT * FROM `usercred` WHERE `email`=?  LIMIT 1 ", [$data['email']], "s");

    if (mysqli_num_rows($uexist) == 0) {
        echo 'inv_email';
        //exit;
        
    }
    else
    {
        $ufetch = mysqli_fetch_assoc($uexist);
        if($ufetch['isverify']==0)
        {
            echo 'not_verified';
        }
        else if($ufetch['status']==0)
        {
           echo 'inactive';
        }
        else
        {
            //send reset link to email
            $token = bin2hex(random_bytes(16));

            if(!sendMail($data['email'],$token,"accountrecovery"))
            {
                echo 'mail_failed';
            }
            else{
                
                $date = date("Y-m-d");
                $query=mysqli_query($con,"UPDATE `usercred` SET `token`='$token',`texpire`='$date' 
                WHERE `id`='$ufetch[id]'");

                if($query)
                {
                    echo 1;
                }
                else{
                    echo 'upd_failed';
                }

            }
        }
    }
}


if (isset($_POST['recoveruser']))
{
    $data=filteration($_POST);

    $encpass= password_hash($data['pass'], PASSWORD_BCRYPT);

    $query="UPDATE `usercred` SET `password`=? ,`token`=?, `texpire`=? 
              WHERE `email`=? AND `token`=? ";

    $values=[$encpass,null,null,$data['email'],$data['token']] ;

    if(update($query,$values,'sssss'))
    {
        echo 1;
    }
    else
    {
        echo 'failed';
    }

}


?>
