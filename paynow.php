
<?php


require ('admin/inc/dbconfig.php');
require ('admin/inc/essentials.php');

//if paytm aproved your request then this code helpful either create other integration payment
require ('inc/paytm/config_paytm.php');
require ('inc/paytm/encdec_paytm.php');

date_default_timezone_set("Asia/kolkata");

session_start();

if (!(isset ($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}

if (isset ($_POST['paynow'])) {
    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");

    $checkSum = "";


    $ORDER_ID = 'ORD_' . $_SESSION['uid'] . random_int(1111, 9999999);
    $CUST_ID = $_SESSION['uid'];
    $INDUSTRY_TYPE_ID = INDUSTRY_TYPE_ID;
    $CHANNEL_ID = CHANNEL_ID;
    $TXN_AMOUNT = $_SESSION['event']['payment'];

    $paramList = array();

    // Create an array having all required parameters for creating checksum.
    $paramList["MID"] = PAYTM_MERCHANT_MID;
    $paramList["ORDER_ID"] = $ORDER_ID;
    $paramList["CUST_ID"] = $CUST_ID;
    $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
    $paramList["CHANNEL_ID"] = $CHANNEL_ID;
    $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
    $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;

    $paramList["CALLBACK_URL"] = CALLBACK_URL;

    //Here checksum string will return by getChecksumFromArray() function.
    $checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);

    //insert payment data into database

    $frmdata = filteration($_POST);

    $query1 = "INSERT INTO `bookingorder`( `userid`, `eventid`, `checkin`, `checkout`, `refund`,`orderid` )VALUES ('?,?,?,?,?')";

    insert($query, [$CUST_ID, $_SESSION['event']['id'], $frmdata['checkin'], $frmdata['checkout'], $ORDER_ID], 'issss');

    $bookingid = mysqli_insert_id($con);

    $query2 = "INSERT INTO `bookingdetails`(`bookingid`, `eventname`, `price`, `totalpay`, `username`, `pnum`, `address`) VALUES (?,?,?,?,?,?,?)";

    insert($query2, [$bookingid, $_SESSION['event']['name'], $_SESSION['event']['price'], $TXN_AMOUNT, $frmdata['name'], $frmdata['pnum'], $frmdata['address']], 'issssss');

}

?>

<html>

<head>
    <title>Processing</title>
</head>
<body>
	<h1>Please do not refresh this page...</h1><
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo isset($checkSum) ?>"> <!--$checkSum-->
			
			</form>
			
		<script type="text/javascript">
			document.f1.submit();
		</script>
	
</body>
</html>




