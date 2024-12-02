<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> <!-- tailwind css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> <!-- Swiper js -->

    <?php require('inc/links.php'); ?>
    <title>
        <?php echo $settingsr['sitetitle'] ?>-Home
    </title>
    <style>
        .Availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        @media screen and(max-width:575px) {
            .Availability-form {
                margin-top: 25px;
                padding: 0 35px;


            }

        }
    </style>

</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>
    <br>
    <br>

    <!--Carousel  -->

    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php

                $res = selectAll('carousel');
                while ($row = mysqli_fetch_assoc($res)) {
                    $path = CAROUSEL_IMG_PATH;
                    echo <<<data
                     
                       <div class="swiper-slide">
                        <img src="$path$row[image]" class="w-100  d-block" />
                       </div>
                      
                    data;
                }

                ?>

                <!--<div class="swiper-slide">
                    <img src="images1\img7.jpg" class="w-100  d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="images1\img2.jpg" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="images1\img4.jpg" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="images1\img5.jpg" class="w-100 d-block" />
                </div>-->
            </div>
            <!--  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                   <div class="swiper-pagination"></div>-->
        </div>
    </div>
    <br><br>

    <!--Check Availability 
    <div class="container Availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Check Booking Availability </h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-In</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-Out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;"> Adult</label>
                            <select class="form-select shadow-none">
                                <option selected> Open this select menu </option>
                                <option value="1">one</option>
                                <option value="2">two</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight: 500;"> child</label>
                            <select class="form-select shadow-none">
                                <option selected> Open this select menu </option>
                                <option value="1">one</option>
                                <option value="2">two</option>
                            </select>
                        </div>
                        <div class="col-lg-1  mb-lg-3 mt-2">
                            <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
            -->


    <!--Events Cart -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Events </h2>

    <div class="container">
        <div class="row">
            <?php

            // $rowres = select("SELECT * FROM `event` WHERE `status`=? AND `removed`=? ORDER BY id DESC", [1, 0], 'ii');
            
            $rowres = select("SELECT * FROM `event` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');
            while ($eventdata = mysqli_fetch_assoc($rowres)) {
                //getfeature of event
            
                $feaq = mysqli_query($con, "SELECT f.name FROM `feature` f 
                     INNER JOIN `eventfeature` rfea ON f.id = rfea.featureid
                     WHERE rfea.eventid = '$eventdata[id]' ");

                $featuredata = "";
                while ($fearow = mysqli_fetch_assoc($feaq)) {
                    $featuredata .= " <span class='badge bg-light text-dark mb-1 text-wrap me-1 mb-1'>
            $fearow[name] </span>";

                }

                //getfeature of event
                $facq = mysqli_query($con, "SELECT f.name FROM `facility` f
                       INNER JOIN `eventfacility` rfac ON f.id= rfac.facilityid
                        WHERE rfac.eventid = '$eventdata[id]'");

                $facilitydata = "";
                while ($facrow = mysqli_fetch_assoc($facq)) {
                    $facilitydata .= " <span class='badge bg-light text-dark mb-1 text-wrap me-1 mb-1'>
            $facrow[name] </span>";

                }
                //get THumbnail of image
                $eventthumb = EVENT_IMG_PATH . "thumbnail.jpg";
                $thumbq = mysqli_query($con, "SELECT * FROM `eventimage`
                WHERE `eventid`='$eventdata[id]' AND `thumb`='1' ");

                if (mysqli_num_rows($thumbq) > 0) {
                    $thumbres = mysqli_fetch_assoc($thumbq);
                    $eventthumb = EVENT_IMG_PATH . $thumbres['image'];
                }

                //book event
              /*  $bookbtn="";
                if(!$settingsr['shutdown'])
                {
                  $login=0;
                  if(isset($_SESSION['login']) && $_SESSION['login']==true)
                  {
                    $login=1;
                  }  
                  $bookbtn= "<button  onclick='checkLoginToBook($login,$eventdata[id])' class='btn brn-sm text-white custom-bg  shadow-none'>Book Now</button>";
                }
                */
                $bookbtn = "";
                if (!$settingsr['shutdown']) 
                {
                   $login = 0;
                    if (isset($_SESSION['login']) && $_SESSION['login'] == true)
                     {
                       $login = 1;
                     }
                 $bookbtn = "<button onclick='checkLoginToBook($login, " . $eventdata['id'] . ")' class='btn brn-sm text-white custom-bg  shadow-none'>Book Now</button>";
                }




                //print event cart*************************************************************************************
                echo <<<data
                <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
                    <img style="height:250px;" src="$eventthumb" class="card-img-top">
                    <div class="card-body">
                        <h5>$eventdata[name]</h5>
                        <h6 class="mb-4"> 200 price</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Feature</h6>
                            $featuredata
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            $facilitydata
                        </div>
                        <div class="Venues mb-4">
                            <h6 class="mb-1">Venues</h6>
                            $eventdata[venue]
                           
                        </div>
                        <div class="Venues mb-1">
                        <h6 class="mb-1">Guest</h6>
                           $eventdata[guest]
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>

                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            $bookbtn
                            <a href="eventdetail.php?id=$eventdata[id]" class="btn brn-sm btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
        data;


            }

            ?>

            <!-- statically store cart event
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
                    <img style="height:250px;" src="images1\img4.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Simple room name</h5>
                        <h6 class="mb-4"> 200 price</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">features</h6>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                wifi
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                tv
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                        </div>
                        <div class="Venues mb-4">
                            <h6 class="mb-1">Venues</h6>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                wifi
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                tv
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>

                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn brn-sm text-white custom-bg  shadow-none">Book Now</a>
                            <a href="#" class="btn brn-sm btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
                    <img style="height:250px;" src="images1\img4.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Simple room name</h5>
                        <h6 class="mb-4"> 200 price</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">features</h6>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                wifi
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                tv
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                        </div>
                        <div class="Venues mb-4">
                            <h6 class="mb-1">Venues</h6>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                wifi
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                tv
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>

                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn brn-sm text-white custom-bg  shadow-none">Book Now</a>
                            <a href="#" class="btn brn-sm btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
                    <img style="height:250px;" src="images1\img4.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Simple room name</h5>
                        <h6 class="mb-4"> 200 price</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">features</h6>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                wifi
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                tv
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                        </div>
                        <div class="Venues mb-4">
                            <h6 class="mb-1">Venues</h6>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                wifi
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                tv
                            </span>
                            <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                                sound
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>

                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn brn-sm text-white custom-bg  shadow-none">Book Now</a>
                            <a href="#" class="btn brn-sm btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
            -->



            <div class="col-lg-12 text-center mt-5">
                <a href="events.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Events>></a>
            </div>
        </div>
    </div>


    <!--facilities-->
    <h2 class="mt-5 pt-4 mb-1 text-center fw-bold h-font">facilities </h2>
    <div class="container">
        <div class="row justify-content-evenly px-md-0 px-5">
            <?php

            //  $res = mysqli_query($con,"SELECT * FROM `facility`  ORDER BY id DESC LIMIT ");
            $res = mysqli_query($con, "SELECT * FROM `facility` ORDER BY id DESC");
            $path = FACILITY_IMG_PATH;

            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data
                        <div class="col-lg-2 col-md-2 text-center bg-light rounded shadow py-4 my-3">
                        <img class="border-color: dark;"src="$path$row[icon]" width="40px" height="50px">

                        <h5 class="mt-3">$row[name]</h5>
                       </div>
                       
                data;
            }


            ?>
            <!--it is statically store  
            <div class="col-lg-2 col-md-2 text-center bg-light rounded shadow py-4 my-3">
                <img class="border-color: dark;"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbu-h8Rah2rPKrVNpZh_6CgP5yxCx0e7p35fsVPrcLdYNHrwUXSCBIyXzODQ&s"
                    width="80px">
                <h5 class="mt-3">Sound</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-light rounded shadow py-4 my-3">
                <img class="border-color: dark;"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbu-h8Rah2rPKrVNpZh_6CgP5yxCx0e7p35fsVPrcLdYNHrwUXSCBIyXzODQ&s"
                    width="80px">
                <h5 class="mt-3">Sound</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-light rounded shadow py-4 my-3">
                <img class="border-color: dark;"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbu-h8Rah2rPKrVNpZh_6CgP5yxCx0e7p35fsVPrcLdYNHrwUXSCBIyXzODQ&s"
                    width="80px">
                <h5 class="mt-3">Sound</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-light rounded shadow py-4 my-3">
                <img class="border-color: dark;"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbu-h8Rah2rPKrVNpZh_6CgP5yxCx0e7p35fsVPrcLdYNHrwUXSCBIyXzODQ&s"
                    width="80px">
                <h5 class="mt-3">Sound</h5>
            </div>
        -->
            <div class="col-lg-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More
                    Facilities>></a>
            </div>

        </div>
    </div>


    <!--Testimonals-->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">testimonals </h2>

    <div class="container mt-5">
        <div class="swiper swiper-testimonial">
            <div class="swiper-wrapper mb-5">
                <!--user comments-->
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img style="height: 3%;  width: 30px;" src="images1\star-full-icon (1).svg">
                        <h6 class="m-0 ms-2"> Random user1</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, id qui earum repellendus
                        quibusdam pariatur consequatur
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img style="height: 3%;  width: 30px;" src="images1\star-full-icon (1).svg">
                        <h6 class="m-0 ms-2"> Random user2</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis
                        ducimus qui tempora aliquam amet magnam neque,
                        ex nisi assumenda, numquam vero, endus
                        quibusdam pariatur consequatur
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img style="height: 3%;  width: 30px;" src="images1\star-full-icon (1).svg">
                        <h6 class="m-0 ms-2"> Random user3</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, id qui earum repellendus
                        quibusdam pariatur consequatur
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="col-lg-12 text-center mt-5">
            <a href="about.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More>></a>
        </div>
    </div>
    <!--Testimonals Closed-->



    <!--ReachedUs-->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">ReachUs </h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe src="<?php echo $contactr['iframe'] ?>" class="w-100 rounded" height="320"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <!--CallUs-->
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Call Us</h5>
                    <a href="tel: +<?php echo $contactr['pn1'] ?>"
                        class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +
                        <?php echo $contactr['pn1'] ?>
                    </a>
                    <br>

                    <?php
                    if ($contactr['pn2'] != '') {
                        echo <<<data
                      <a href="tel: + $contactr[pn2] " class="d-inline-block mb-2 text-decoration-none text-dark">
                      <i class="bi bi-telephone-fill"></i> + $contactr[pn2]
                      </a>
                      data;
                    }
                    ?>
                    <!-- <a href="tel: +<?php // echo $contactr['pn2']          ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +<?php // echo $contactr['pn2']          ?></a>-->
                </div>
                <!--twitter,facebook,instagram-->
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Follow Us</h5>
                    <?php
                    if ($contactr['tw'] != '') {
                        echo <<<data
                            <a href="$contactr[tw] " class="d-inline-block mb-3">
                               <span class="badge bg-light text-dark fs-6 p-2">
                              <i class="bi bi-twitter-x me-1"></i> Twitter-x
                               </span>
                              </a>
                            <br>
                        data;
                    }
                    ?>
                    <!--  <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-twitter-x me-1"></i> Twitter-x
                        </span>
                    </a>
                    <br>-->
                    <a href="<?php echo $contactr['fb'] ?>" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-facebook me-1"></i> Facebook
                        </span>
                    </a>
                    <br>
                    <a href="<?php echo $contactr['insta'] ?>" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-instagram me-1"></i> Instagram
                        </span>
                    </a>
                    <br>

                </div>
            </div>
        </div>
    </div>




    <!--Password Reset modal-->

    <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="recoveryform">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-shield-lock fs-3 me-2"></i> Set up new password
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label">New Password</label>
                            <input type="password" name="pass" required class="form-control shadow-none">
                            <input type="hidden" name="email">
                            <input type="hidden" name="token">
                        </div>
                        <div class=" mb-2 text-end">

                            <button type="button" class="btn shadow-none me-lg-3 me-2 p-0" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-dark shadow-none">Reset Password </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <!-- footer connection-->
    <?php require('inc/footer.php'); ?>

    <?php
    /*
        if (isset($_GET['accountrecovery'])) {

            $data = filteration($_GET);

            $tdate = date("Y-m-d");

            $query = select(
                "SELECT * FROM `usercred` WHERE `email`=? AND `token`=? AND `texpire`=? LIMIT 1",
                [$data['email'], $data['token'], $tdate],
                'sss'
            );

            if (mysqli_num_rows($query) == 1) {
                echo <<<showModal
                <script>
                var myModal = document.getElementById('recoveryModal');

                myModal.querySelector("input[name='email']").value = '$data[email]';
                myModal.querySelector("input[name='token']").value = '$data[token]';

                var modal = bootstrap.Modal.getOrCreateInstance(myModal);
                modal.show();
                </script>
               showModal;
            } else {
                alert("error", "Invalid or Expired Link!");
            }
        }*/

    if (isset($_GET['accountrecovery'])) {
        $data = filteration($_GET);
        $tdate = date("Y-m-d");

        $query = select(
            "SELECT * FROM `usercred` WHERE `email`=? AND `token`=? AND `texpire`=? LIMIT 1",
            [$data['email'], $data['token'], $tdate],
            'sss'
        );

        if ($query) {
            if (mysqli_num_rows($query) == 1) {
                $email = htmlspecialchars($data['email']);
                $token = htmlspecialchars($data['token']);
                echo "<script>
                    var myModal = document.getElementById('recoveryModal');
                    myModal.querySelector('input[name=\"email\"]').value = '$email';
                    myModal.querySelector('input[name=\"token\"]').value = '$token';
                    var modal = new bootstrap.Modal(myModal);
                    modal.show();
                  </script>";
            } else {
                echo "<script>alert('error', 'Invalid or Expired Link!');</script>";
            }
        } else {
            echo "<script>alert('error', 'Database error. Please try again.');</script>";
        }
    }
    ?>



    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> <!--swiper js script -->

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            }
            /* navigation: {
               nextEl: ".swiper-button-next",
               prevEl: ".swiper-button-prev",
             },
             pagination: {
               el: ".swiper-pagination",
               clickable: true,
             },*/
        });

        var swiper = new Swiper(".swiper-testimonial", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 2,
                },
                720: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },


            }
        });

/*
        //recovery account

        let recoveryform = document.getElementById('recoveryform');

        recoveryform.addEventListener('submit', (e) => {
            e.preventDefault();

            let data = new FormData();

            data.append('email', recoveryform.elements['email'].value);
            data.append('token', recoveryform.elements['token'].value);
            data.append('pass', recoveryform.elements['pass'].value);
            data.append('recoveruser', '');

            var myModal = document.getElementById('recoveryModal');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            let xhr = new XMLHttpRequest(); //it is object
            xhr.open("POST", "ajax/loginregister.php", true);

            xhr.onload = function () {
                console.log('Response:', this.responseText);
                if (this.responseText == 'failed') {
                    alert('error', 'Account Reset Failed');

                }
                else {
                    alert('success', 'Account Reset Successful');
                    recoveryform.reset();
                }
            }

            xhr.send(data);
        });
*/

//recovery account

let recoveryform = document.getElementById('recoveryform');

recoveryform.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();

    data.append('email', recoveryform.elements['email'].value);
    data.append('token', recoveryform.elements['token'].value);
    data.append('pass', recoveryform.elements['pass'].value);
    data.append('recoveruser', '');

    var myModal = document.getElementById('recoveryModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/loginregister.php", true);

    xhr.onprogress = function () {
        // Handle progress
    }

    xhr.onerror = function () {
        alert('error', 'An error occurred while processing your request.');
    }

    xhr.onload = function () {
        console.log('Response:', this.responseText);
        if (this.responseText == 'failed') {
            alert('error', 'Account Reset Failed');
        } else {
            alert('success', 'Account Reset Successful');
            recoveryform.reset();
        }
    }

    xhr.send(data);
});


    </script>




</body>

</html>