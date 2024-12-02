<?php 
      require('inc/dbconfig.php'); 
      require('inc/essentials.php');
      
      session_start();
      if((isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']==true)){
         redirect('dashboard.php');
      }
      
      
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('inc/links.php'); ?>

    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>

</head>

<body class="bg-light">





    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form method="POST">
            <h4 class="bg-dark text-white py-3">Admin Login Panel</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="adminname" required type="text" class="form-control shadow-none text-center"
                        placeholder="Admin Name">
                </div>
                <div class="mb-4">
                    <input name="adminpass" required type="password" class="form-control shadow-none text-center"
                        placeholder="Password">
                </div>
                <button name="login" type="submit" class="btn text-dark custom-bg shadow-none"> LOGIN </button>
            </div>
        </form>
    </div>




    <?php
    if (isset($_POST['login'])) {
        $frm_data = filteration($_POST);

        $query = "SELECT * FROM `admincred` WHERE `adminname`=? AND `adminpass`=?";
        $values = [$frm_data['adminname'], $frm_data['adminpass']];
        // $datatypes ="ss";
    
        $res = select($query, $values, "ss");
        // print_r($res);
        if ($res->num_rows == 1) {
            $row =mysqli_fetch_assoc($res);
            $_SESSION['adminlogin'] =true;
            $_SESSION['adminid'] = $row['srno'];
            redirect('dashboard.php');

        } else {
            alert('error','Login failed- Invalid Credentials');
           /* //herodoc method for printing alert is constant in this indent is very important!!!!
            echo <<<alert
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
               <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            alert;*/
        }


    }

    ?>



    <?php require('inc\scripts.php'); ?>

</body>

</html>