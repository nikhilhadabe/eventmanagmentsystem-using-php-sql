<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@20;400;500&family=Roboto&display=swap"
    rel="stylesheet">

<link rel="stylesheet" href="css\common.css">

<?php

session_start();
date_default_timezone_set("Asia/kolkata");

require('admin/inc/dbconfig.php');
require('admin/inc/essentials.php');


   $contactq = "SELECT * FROM `contactdetails` WHERE `srno`=?";
   $settingsq = "SELECT * FROM `settings` WHERE `srno`=?";
   $values = [1];
   $contactr = mysqli_fetch_assoc(select($contactq, $values, 'i'));
   $settingsr= mysqli_fetch_assoc(select($settingsq, $values, 'i'));
   //print_r($contactr);

   /*
   // Assuming you have a function named `select` that executes the query and returns the result set
   $contactq = "SELECT * FROM `contactdetails` WHERE `srno`=?";
   $values = [1];
   $result = select($contactq, $values, 'i'); // Assuming `select` is a custom function for executing queries
   if ($result) {
   $contactr = mysqli_fetch_assoc($result);
   print_r($contactr);
   } else {
   echo "Query failed";
   }
   */

   $contactq = "SELECT * FROM `contactdetails` WHERE `srno`=?";
   $values = [1];
   $contactr = mysqli_fetch_assoc(select($contactq, $values, 'i'));

   if($settingsr['shutdown'])
   {
    echo<<<alertbar
      <div class='bg-danger text-center p-2 fw-bold'>
       <i class="bi bi-exclamation-triangle-fill"></i>
       Bookings are Temporary Closed!

      </div>
    alertbar;
   }



?>