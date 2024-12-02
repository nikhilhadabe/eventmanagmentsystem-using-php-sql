<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> <!-- tailwind css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> <!-- Swiper js -->
    <link rel="stylesheet" href="css\common.css">

    <?php require('inc/links.php'); ?>
    <title><?php  echo $settingsr['sitetitle'] ?>-Events</title>

    <style>
        .pop:hover {
            border-color: var(--teal) ! important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>

</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Events</h2>
        <div class="h-line bg-dark"></div>


    </div>

    <div class="container-fluid">
        <div class="row">

            <!--filters-->
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column akign-items-stretch">
                        <h4>filters</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterdropdown" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="filterdropdown">

                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size:18px;"> Check Availability</h5>
                                <label class="font-label"> Check-IN</label>
                                <input type="date" class="form-control shadow-none mb-3">
                                <label class="font-label"> Check-Out</label>
                                <input type="date" class="form-control shadow-none">
                            </div>


                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size:18px;"> facilities</h5>
                                <div class="mb-2">
                                    <input type="checkbox" class="form-check-input shadow-none me-1">
                                    <label class="form-label" form="f1">facilities-one</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" class="form-check-input shadow-none me-1">
                                    <label class="form-label" form="f2">facilities-two</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" class="form-check-input shadow-none me-1">
                                    <label class="form-label" form="f3">facilities-three</label>
                                </div>

                            </div>


                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size:18px;"> Guests</h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="font-label"> Adults</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                    <div>
                                        <label class="font-label"> Childeren</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9 col-md-12 px-4">

                <?php

                $rowres = select("SELECT * FROM `event` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');
                while ($eventdata = mysqli_fetch_assoc($rowres)) {

                    /* //getfeature of event
                 
                     $feaq = mysqli_query($con, "SELECT f.name FROM `feature` f 
                       INNER JOIN `eventfeature` rfea ON f.id = rfea.featureid
                        WHERE rfea.eventid = '$eventdata[id]' ");

                     $featuredata = "";
                     while ($fearow = mysqli_fetch_assoc($feaq)) {
                         $featuredata .= " <span class='badge bg-light text-dark mb-1 text-wrap me-1 mb-1'>
                             $fearow[name] </span>";

                     }
                     */
                    //getfeature of event
                
                    $feaq = mysqli_query($con, "SELECT f.name FROM `feature` f 
                             INNER JOIN `eventfeature` rfea ON f.id = rfea.featureid
                             WHERE rfea.eventid = '$eventdata[id]' ");

                    $featuredata = "";
                    $features = [];
                    while ($fearow = mysqli_fetch_assoc($feaq)) {
                        $features[] = $fearow['name'];
                    }

                    $featureCount = count($features);
                    foreach ($features as $key => $feature) {
                        if ($key < $featureCount - 1) {
                            $featuredata .= " <span class='badge bg-light text-dark mb-1 text-wrap me-1 mb-1'>$feature</span>";
                        }
                    }


                    /*  //getfacility of event this code is right but last facility display twice in cart
                      $facq = mysqli_query($con, "SELECT f.name FROM `facility` f
                          INNER JOIN `eventfacility` rfac ON f.id= rfac.facilityid
                           WHERE rfac.eventid = '$eventdata[id]'");

                      $facilitydata = "";
                      while ($facrow = mysqli_fetch_assoc($facq)) {
                          $facilitydata .= " <span class='badge bg-light text-dark mb-1 text-wrap me-1 mb-1'>
                              $facrow[name] </span>";

                      }
                      */
                    //getfacility of event
                    $facq = mysqli_query($con, "SELECT f.name FROM `facility` f
                              INNER JOIN `eventfacility` rfac ON f.id= rfac.facilityid
                               WHERE rfac.eventid = '$eventdata[id]'");

                    $facilitydata = "";
                    $facilities = [];
                    while ($facrow = mysqli_fetch_assoc($facq)) {
                        $facilities[] = $facrow['name'];
                    }

                    $facilityCount = count($facilities);
                    foreach ($facilities as $key => $facility) {
                        if ($key < $facilityCount - 1) {
                            $facilitydata .= " <span class='badge bg-light text-dark mb-1 text-wrap me-1 mb-1'>$facility</span>";
                        }
                    }


                    //get THumbnail of image
                    $eventthumb = EVENT_IMG_PATH . "thumbnail.jpg";
                    $thumbq = mysqli_query($con, "SELECT * FROM `eventimage`
         WHERE `eventid`='$eventdata[id]' AND `thumb`='1' ");

                    if (mysqli_num_rows($thumbq) > 0) {
                        $thumbres = mysqli_fetch_assoc($thumbq);
                        $eventthumb = EVENT_IMG_PATH . $thumbres['image'];
                    }

                 //when site shutdown booknow btn hidden
                    $bookbtn="";
                  if(!$settingsr['shutdown'])
                   {
                      $login = 0;
                     if (isset($_SESSION['login']) && $_SESSION['login'] == true){
                       $login = 1;
                     }
                     $bookbtn= "<button onclick='checkLoginToBook($login, " . $eventdata['id'] . ")' class='btn brn-sm w-100 text-white custom-bg  shadow-none mb-2'>Book Now</button>";
                   }

                    //print event cart*************************************************************************************
                    echo <<<data
                        <div class='card mb-4 border-0 shadow'>
                        <div class="row g-0 p-3 align-items-center">
                            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                <img src="$eventthumb" class="img-fluid rounded">
                            </div>
                            <div class="col-md-5 px-lg-3 px-md-3 px-0">
                                <h5 class="mb-1">$eventdata[name]</h5>
                                <div class="features mb-1">
                                    <h6 class="mb-1">features</h6>
                                                                $featuredata
                                </div>
                                <div class="facilities mb-1">
                                    <h6 class="mb-1">Facilities</h6>
                                                               $facilitydata
                                </div>
                                <div class="Venues mb-1">
                                    <h6 class="mb-1">Venues</h6>
                                   $eventdata[venue]
                                </div>
                                <div class="Venues mb-1">
                                <h6 class="mb-1">Guest</h6>
                               $eventdata[guest]
                            </div>
                            </div>
                            <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                                <h6 class="mb-4"> $eventdata[price]₹</h6>
                                 $bookbtn
                                <a href="eventdetail.php?id=$eventdata[id]" class="btn brn-sm w-100 btn-outline-dark shadow-none">More Details</a>
                            </div>
                        </div>
                    </div>
                    data;


                }

                ?>

                <!--  <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="webImages\rooms\1.jpg" class="img-fluid rounded">
                        </div>

                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-1">events name</h5>
                            <div class="features mb-1">
                                <h6 class="mb-1">features</h6>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                            </div>
                            <div class="facilities mb-1">
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
                            <div class="Venues mb-1">
                                <h6 class="mb-1">Venues/guest</h6>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    wifi
                                </span>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    tv
                                </span>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                            </div>
                        </div>

                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                            <h6>200 per night</h6>
                            <a href="#" class="btn brn-sm w-100 text-white custom-bg  shadow-none mb-2 ">Book Now</a>
                            <a href="#" class="btn brn-sm w-100 btn-outline-dark shadow-none">More Details</a>

                        </div>

                    </div>
                </div>-->

                <!--
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="webImages\rooms\1.jpg" class="img-fluid rounded">
                        </div>

                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-1">events name</h5>
                            <div class="features mb-1">
                                <h6 class="mb-1">features</h6>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                            </div>
                            <div class="facilities mb-1">
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
                            <div class="Venues mb-1">
                            <h6 class="mb-1">Venues/guest</h6>
                            <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                wifi
                            </span>
                            <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                tv
                            </span>
                            <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                sound
                            </span>
                        </div>
                        </div>

                        <div class="col-md-2 text-center">
                            <h6>200 per night</h6>
                            <a href="#" class="btn brn-sm w-100 text-white custom-bg  shadow-none mb-2 ">Book Now</a>
                            <a href="#" class="btn brn-sm  w-100 btn-outline-dark shadow-none">More Details</a>

                        </div>

                    </div>
                </div>

                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="webImages\rooms\1.jpg" class="img-fluid rounded">
                        </div>

                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-1">events name</h5>
                            <div class="features mb-1">
                                <h6 class="mb-1">features</h6>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                            </div>
                            <div class="facilities mb-1">
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
                            <div class="Venues mb-1">
                            <h6 class="mb-1">Venues/guest</h6>
                            <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                wifi
                            </span>
                            <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                tv
                            </span>
                            <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                sound
                            </span>
                        </div>
                        </div>

                        <div class="col-md-2 text-center">
                            <h6>200 per night</h6>
                            <a href="#" class="btn brn-sm  w-100 text-white custom-bg  shadow-none mb-2 ">Book Now</a>
                            <a href="#" class="btn brn-sm  w-100 btn-outline-dark shadow-none">More Details</a>

                        </div>

                    </div>
                </div>

                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="webImages\rooms\1.jpg" class="img-fluid rounded">
                        </div>

                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-1">events name</h5>
                            <div class="features mb-1">
                                <h6 class="mb-1">features</h6>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                                <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                    sound
                                </span>
                            </div>
                            <div class="facilities mb-1">
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
                            <div class="Venues mb-1">
                            <h6 class="mb-1">Venues/guest</h6>
                            <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                wifi
                            </span>
                            <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                tv
                            </span>
                            <span class="badge bg-light text-dark mb-1 text-wrap lh-base">
                                sound
                            </span>
                        </div>
                        </div>

                        <div class="col-md-2 text-center">
                            <h6>200 per night</h6>
                            <a href="#" class="btn brn-sm  w-100 text-white custom-bg  shadow-none mb-2 ">Book Now</a>
                            <a href="#" class="btn brn-sm  w-100 btn-outline-dark shadow-none">More Details</a>

                        </div>

                    </div>
                </div>-->

            </div>
        </div>
    </div>


    <!-- footer connection-->
    <?php require('inc/footer.php'); ?>






</body>

</html>