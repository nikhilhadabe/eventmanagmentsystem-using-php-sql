<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> <!-- tailwind css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> <!-- Swiper js -->
    <link rel="stylesheet" href="css\common.css">



    <script src="https://js.stripe.com/v3/"></script>
    <?php require ('inc/stripe-php-master/config.php'); ?>






    <?php require ('inc/links.php'); ?>
    <title>
        <?php echo $settingsr['sitetitle'] ?>-BOOKING STATUS
    </title>

</head>

<body class="bg-light">

    <?php require ('inc/header.php'); ?>

   


    <div class="container">
        <div class="row ">

            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold">PAYMENT STATUS</h2>
            </div>


            <?php

            $frmdata= filteration($_GET);

            if (!(isset ($_SESSION['login']) && $_SESSION['login'] == true)) {
                redirect('index.php');
            }

            $bookingq="SELECT * FROM `bookingorder` bo 
                 INNER JOIN `bookingdetails` bd ON bo.bookingid=bd.bookingid
                 WHERE bo.orderid=? AND bo.userid=? AND bo.bookingstatus!=?  ";

            $bookingres=select($bookingq,[$frmdata['order'],$_SESSION['uid'],'pending'],'sis');
            
            if(mysqli_num_rows($bookingres)==0)
            {
                redirect('index.php');
            }

            $bookingfetch= mysqli_fetch_assoc($bookingres);


            if($bookingfetch['transstatus']=="TXN_SUCCESS")
            {
              echo<<<data
              <div class="col-12 px-4">
              <p class="fw-bold alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                Payment done! Booking Successful.
                <br>
                <a href='bookings.php'>Go to Bookings</a>
              </p>
              data;
            }
            else
            {
                echo<<<data
              <div class="col-12 px-4">
              <p class="fw-bold alert alert-danger">
                <i class="bi bi-exclamation-traingle-fill"></i>
                Payment Failed! $bookingfetch[transrespmsg]
                <br>
                <a href='bookings.php'>Go to Bookings</a>
              </p>
              data;

            }


             ?>


        </div>
    </div>


    <!-- footer connection-->
    <?php require ('inc/footer.php'); ?> 




</body>

</html>