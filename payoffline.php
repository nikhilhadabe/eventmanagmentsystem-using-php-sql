
<?php
require('admin/inc/dbconfig.php');
require('admin/inc/essentials.php');

date_default_timezone_set("Asia/kolkata");

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}

if (isset($_POST['payoffline'])) {
    $frmdata = filteration($_POST);

    $query1 = "INSERT INTO `bookingorder`( `userid`, `eventid`, `checkin`, `checkout`, `refund`) VALUES (?,?,?,?,?)";

    insert($query1, [$_SESSION['uid'], $_SESSION['event']['id'], $frmdata['checkin'], $frmdata['checkout'], '0'], 'issss');

    $bookingid = mysqli_insert_id($con);

    $query2 = "INSERT INTO `bookingdetails`(`bookingid`, `eventid`, `eventname`, `price`, `totalpay`, `username`, `pnum`, `address`) VALUES (?,?,?,?,?,?,?,?)";

    insert($query2, [$bookingid, $_SESSION['event']['id'], $_SESSION['event']['name'], $_SESSION['event']['price'], $_SESSION['event']['payment'], $frmdata['name'], $frmdata['pnum'], $frmdata['address']], 'isssssss');

    // Fetch event details here
    $eventQuery = "SELECT * FROM `event` WHERE `id`=?";
    $eventResult = select($eventQuery, [$_SESSION['event']['id']], 'i');
    $eventData = mysqli_fetch_assoc($eventResult);

    // You can use $eventData to display the event details or for further processing
}
?>

<html>
<head>
    <title>Processing</title>
</head>
<body>
    <h1>Please do not refresh this page...</h1>
    <!-- Display event details if needed -->
    <?php if (isset($eventData)) : ?>
        <h2>Event Details</h2>
        <p>Name: <?php echo $eventData['name']; ?></p>
        <p>Date: <?php echo $eventData['date']; ?></p>
        <!-- Add more event details as needed -->
    <?php endif; ?>
    <form method="post" action="process_payment.php" name="f1">
        <input type="hidden" name="param1" value="value1">
        <input type="hidden" name="param2" value="value2">
        <input type="hidden" name="param3" value="value3">
        <button name="payoffline" class="btn w-100 text-white custom-bg shadow-none mb-1" onclick="createPaymentForm()">Pay offline</button>

    </form>
</body>
</html>


<script>
    document.getElementById('paymentForm').addEventListener('submit', function() {
        // Redirect to index.php after form submission
        window.location.href = 'index.php';
    });

    function createPaymentForm() {
    let form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'process_payment.php'); // Change 'process_payment.php' to your processing script

    // Create and append input fields
    let fields = ['name', 'pnum', 'venue', 'price', 'checkin', 'checkout'];
    fields.forEach(field => {
        let input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', field);
        input.value = bookingform.elements[field].value;
        form.appendChild(input);
    });

    // Append the form to the document and submit it
    document.body.appendChild(form);
    form.submit();
}

</script>