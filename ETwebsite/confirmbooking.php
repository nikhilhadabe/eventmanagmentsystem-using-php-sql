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
        <?php echo $settingsr['sitetitle'] ?>-CONFIRM BOOKING
    </title>

</head>

<body class="bg-light">

    <?php require ('inc/header.php'); ?>

    <?php
    /*
    check event id from url is present or not
    shutdown mode is active or not
    USer is logged in or not
    */


    if (!isset ($_GET['id']) || $settingsr['shutdown'] == true) {
        redirect('events.php');
    } else if (!(isset ($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('events.php');
    }

    //filter and get event and user data
    

    $data = filteration($_GET);

    $eventres = select("SELECT * FROM `event` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

    if (mysqli_num_rows($eventres) == 0) {
        redirect('events.php');
    }

    $eventdata = mysqli_fetch_assoc($eventres);

    $_SESSION['event'] = [
        "id" => $eventdata['id'],
        "name" => $eventdata['name'],
        "price" => $eventdata['price'],
        "payment" => NULL,
        "available" => false,
    ];

    //  print_r($_SESSION['event']);
    //exit;
    $userres = select("SELECT * FROM `usercred` WHERE `id`=?  LIMIT 1 ", [$_SESSION['uid']], "i");
    $userdata = mysqli_fetch_assoc($userres);

    ?>





    <div class="container">
        <div class="row ">

            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold">Confirm Booking
                </h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="events.php" class="text-secondary text-decoration-none">Event</a>
                    <span class="text-secondary"> > </span>
                    <a href="events.php" class="text-secondary text-decoration-none">Confirm</a>

                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
                <?php

                //get THumbnail of image
                $eventthumb = EVENT_IMG_PATH . "thumbnail.jpg";
                $thumbq = mysqli_query($con, "SELECT * FROM `eventimage`
                                                        WHERE `eventid`='$eventdata[id]' AND `thumb`='1' ");

                if (mysqli_num_rows($thumbq) > 0) {
                    $thumbres = mysqli_fetch_assoc($thumbq);
                    $eventthumb = EVENT_IMG_PATH . $thumbres['image'];
                }

                echo <<<data
                <div class="card p-3  shadow-sm rounded">
                <img src="$eventthumb" class="img-fluid rounded">
                <h5> $eventdata[name]</h5>
                <h5>₹ $eventdata[price]</h5>


                </div>

                data;


                ?>

            </div>

            <!--all details dynamically fetch-->
            <div class="col-lg-5 col-md-12 px-4">
                <div class='card mb-4 border-0 shadow-sm rounded-3'>
                    <div class="card-body">
                        <form action="payoffline.php" id="bookingform">
                            <h6 class="mb-3">BOOKING DETAILS</h6>
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label "> Name</label>
                                    <input name="name" type="text" value="<?php echo $userdata['name'] ?>"
                                        class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label "> Phone Number</label>
                                    <input name="name" type="number" value="<?php echo $userdata['pnum'] ?>"
                                        class="form-control shadow-none" required>
                                </div>
                                <!-- it is optional part venue-->
                                <select class="col-md-6 ps-0 mb-3 form-select form-select-sm"
                                    aria-label=".form-select-sm example">
                                    <option selected>Select Venue</option>
                                    <option value="1">Pune</option>
                                    <option value="2">Mumbai</option>
                                    <option value="3">Alandi</option>
                                </select>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label "> Address</label>
                                    <textarea name="address" class="form-control shadow-none" rows="1"
                                        required><?php echo $userdata['address'] ?></textarea>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label "> Check-IN/start date</label>
                                    <input name="chekin" id="checkin" onchange="checkavailability()" type="date"
                                        class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label "> CHeck_Out/close date</label>
                                    <input name="checkout" id="checkout" onchange="checkavailability()" type="date"
                                        class="form-control shadow-none" required>
                                </div>
                                <div class="col-12">
                                    <div class="spinner-border text-info mb-3 d-none" id="infoloader" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <h6 class="mb-3 text-danger" id="payinfo">Provide Event Start Closed Date </h6>


                                    <button name="paynow" class="btn w-100 text-white custom-bg shadow-none mb-1"
                                        disabled>Pay Now</button>
                                        
                                    <button name="payoffline" class="btn w-100 text-white custom-bg shadow-none mb-1" onclick="createOfflinePaymentForm()"
                                        disabled>Pay offline</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <!-- footer connection-->
    <?php require ('inc/footer.php'); ?>




    <script>
        let bookingform = document.getElementById('bookingform');
        let infoloader = document.getElementById('infoloader');
        let payinfo = document.getElementById('payinfo');

        let checkinval = '';
        let checkoutval = '';

        function checkavailability() {
            let checkinval = bookingform.elements['checkin'].value;
            let checkoutval = bookingform.elements['checkout'].value;

            bookingform.elements['paynow'].setAttribute('disabled', true);
           bookingform.elements['payoffline'].setAttribute('disabled', true);

            if (checkinval !== '' && checkoutval !== '') {
                payinfo.classList.add('d-none');
                payinfo.classList.replace('text-dark', 'text-danger');
                infoloader.classList.remove('d-none');

                let data = new FormData();

                data.append('checkavailability', '');
                data.append('checkin', checkinval);
                data.append('checkout', checkoutval);

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/confirmbooking.php", true);

                xhr.onload = function () {
                    let data = JSON.parse(this.responseText);
                    if (data.status === 'check_in_out_equal') {
                        payinfo.innerText = "You cannot checkout on the same day";
                    } else if (data.status === 'check_out_earlier') {
                        payinfo.innerText = "Checkout date is earlier than checkin date";
                    } else if (data.status === 'check_in_earlier') {
                        payinfo.innerText = "Check-in date is earlier than today's date";
                    } else if (data.status === 'unavailable') {
                        payinfo.innerText = "Event not available for this day";
                    } else {
                        payinfo.innerHTML = "No. of Days: " + data.days + "<br>Total Amount to Pay: Rs" + data.payment;
                        payinfo.classList.replace('text-dark', 'text-danger');
                        bookingform.elements['paynow'].removeAttribute('disabled');
                       bookingform.elements['payoffline'].removeAttribute('disabled');
                        payinfo.classList.remove('d-none');
                    }

                    infoloader.classList.add('d-none');
                };

                xhr.send(data);
            }
        }





    </script>
   


</body>

</html>