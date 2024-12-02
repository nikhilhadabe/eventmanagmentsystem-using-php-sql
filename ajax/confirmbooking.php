<?php

require('../admin/inc/dbconfig.php');
require('../admin/inc/essentials.php');

date_default_timezone_set("Asia/kolkata");

if (isset($_POST['checkavailability']))
{
   $frmdata= filteration($_POST);

   $status="";
   $result="";

   //checkin and checkout validation

   

   $todaydate= new DateTime(date("Y-m-d"));
   $checkindate= new DateTime($frmdata['checkin']);
   $checkoutdate= new DateTime($frmdata['checkout']);

   if($checkindate == $checkoutdate){
    $status ='check_in_out_equal';
    $result =json_encode(["status"=>$status]);
   }

   else if($checkoutdate < $checkindate){
    $status ='check_out_earlier';
    $result =json_encode(["status"=>$status]);
   }

   else if($checkindate > $todaydate){
    $status ='check_in_earlier';
    $result =json_encode(["status"=>$status]);
   }

   //check booking availability if status is blank else return the error

   if($status!='')
   {
    echo $result;
   }
   else
   {
    session_start();
    $_SESSION['event'];

    // run query to check event is available or not 

   $countdays= date_diff($checkindate,$checkoutdate)->days;
   $payment=  $_SESSION['event']['price'] * $countdays;
   
   $_SESSION['event']['payment'] = $payment;
   $_session['event']['available']= true;
   
   $result = json_encode(["status"=>'available', "days"=>$countdays, "payment"=>$payment]);
   echo $result;

   }

}

?>