<?php


require ('admin/inc/dbconfig.php');
require ('admin/inc/essentials.php');

//if paytm aproved your request then this code helpful either create other integration payment
require ('inc/paytm/config_paytm.php');
require ('inc/paytm/encdec_paytm.php');

date_default_timezone_set("Asia/kolkata");

session_start();
unset($_SESSION['event']);


 function regenrate_session($uid)
 {
    $userq=select("SELECT * FROM `usercred` WHERE `id`=? LIMIT 1",[$uid],'i');
    $userfetch= mysqli_fetch_assoc($userq);

    $_SESSION['login']=true;
    $_SESSION['uid']=$userfetch['id'];
    $_SESSION['uname']=$userfetch['name'];
    $_SESSION['upic']=$userfetch['picture'];
    $_SESSION['uphone']=$userfetch['pnum'];
 }



header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE")
 {
    //echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	//echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";

    //checksum verified
        
    //maza code
     $selectquery="SELECT  `bookingid`, `userid` FROM `bookingorder` WHERE `orderid`=? ";       //where `orderid`='$_POST[ORDERID]'";
     
     $selectres=mysqli_query($con,$selectquery);

     if(mysqli_num_rows($selectres)==0)
     {
        redirect('index.php');   //*// //if order id not get or not matched then redirect to index page
     }

     $selectfetch= mysqli_fetch_assoc($selectres);

     if(!(isset($_SESSION['login']) && $_SESSION['login']==true))
     {
        //regenerate sesssion if session are lost
        regenrate_session($selectfetch['userid']);
     }

         
     
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		//echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
        
          
        //*// $updquery="UPDATE `bookingorder` SET `bookingstatus`='booked',`transid`='$_POST[TXNID]',`transamt`='$_POST[TXNAMOUNT]',
        //*// `transstatus`='$_POST[STATUS]', `transrespmsg`='$_POST[RESPMSG]' WHERE  `bookingid`='$selectfetch[bookingid]' ";

        $updquery="UPDATE `bookingorder` SET `bookingstatus`='booked',`transid`='$_POST[TXNID]',`transamt`='$_POST[TXNAMOUNT]',
        `transstatus`='$_POST[STATUS]', `transrespmsg`='$_POST[RESPMSG]' WHERE  `bookingid`='$selectfetch[bookingid]' ";

        mysqli_query($con,$updquery);   

	}
	else {
		//echo "<b>Transaction status is failure</b>" . "<br/>";

        $updquery="UPDATE `bookingorder` SET `bookingstatus`='paymentfailed',`transid`='$_POST[TXNID]',`transamt`='$_POST[TXNAMOUNT]',
        `transstatus`='$_POST[STATUS]', `transrespmsg`='$_POST[RESPMSG]' WHERE  `bookingid`='$selectfetch[bookingid]' ";

         mysqli_query($con,$updquery);


	}
	//if (isset($_POST) && count($_POST)>0 )
	//{ 
	//	foreach($_POST as $paramName => $paramValue) {
	//			echo "<br/>" . $paramName . " = " . $paramValue;
	//	}
	//}

    redirect('paystatus.php?order='.$_POST['ORDER_ID']);

}
else {
	//echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
    //here redirect use beacuse anyone use another api key then he redirect on index page jsa ki mi dusryach use kartoy
    redirect('index.php');
}




?>