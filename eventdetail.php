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

</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <?php
    if (!isset($_GET['id'])) {
        redirect('events.php');
    }

    $data = filteration($_GET);

    $eventres = select("SELECT * FROM `event` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

    if (mysqli_num_rows($eventres) == 0) {
        redirect('events.php');
    }

    $eventdata = mysqli_fetch_assoc($eventres);

    ?>





    <div class="container">
        <div class="row ">

            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold">
                    <?php echo $eventdata['name'] ?>
                </h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="events.php" class="text-secondary text-decoration-none">Event</a>

                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
                <div id="eventcarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $eventimg = EVENT_IMG_PATH . "thumbnail.jpg";
                        $imgq = mysqli_query($con, "SELECT * FROM `eventimage`
                             WHERE `eventid`='$eventdata[id]' ");

                        if (mysqli_num_rows($imgq) > 0) {
                            $activeclass = 'active';
                            while ($imgres = mysqli_fetch_assoc($imgq)) {

                                echo " 
                                  <div class='carousel-item $activeclass'>
                                    <img src='" . EVENT_IMG_PATH . $imgres['image'] . "' class='d-block w-100 rounded'>
                                    </div>
                                 ";
                                $activeclass = '';
                            }
                        } else {
                            echo "  <div class='carousel-item active'>
                                    <img src='$eventimg' class='d-block w-100'>
                                    </div>";
                        }

                        ?>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#eventcarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#eventcarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>

            <!--all details dynamically fetch-->
            <div class="col-lg-5 col-md-12 px-4">
                <div class='card mb-4 border-0 shadow-sm rounded-3'>
                    <div class="card-body">
                        <?php

                        echo <<<price
                         <h4> $eventdata[price]₹</h4>
                       price;

                        echo <<<rating
                            <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            </div>
                       rating;

                        $feaq = mysqli_query($con, "SELECT f.name FROM `feature` f 
                            INNER JOIN `eventfeature` rfea ON f.id = rfea.featureid
                                WHERE rfea.eventid = '$eventdata[id]' ");

                        $featuredata = "";
                        while ($fearow = mysqli_fetch_assoc($feaq)) {
                            $featuredata .= " <span class='badge bg-light text-dark mb-1 text-wrap me-1 mb-1'>
                                    $fearow[name] </span>";

                        }

                        echo <<<feature
                                <div class="features mb-1">
                                <h6 class="mb-1">features</h6>
                                  $featuredata
                                 </div>

                        feature;


                        $facq = mysqli_query($con, "SELECT f.name FROM `facility` f
                        INNER JOIN `eventfacility` rfac ON f.id= rfac.facilityid
                         WHERE rfac.eventid = '$eventdata[id]'");

                        $facilitydata = "";
                        while ($facrow = mysqli_fetch_assoc($facq)) {
                            $facilitydata .= " <span class='badge bg-light text-dark mb-1 text-wrap me-1 mb-1'>
                            $facrow[name] </span>";
                        }

                        echo <<<facility
                            <div class="facilities ">
                            <h6 class="mb-1">Facilities</h6>
                            $facilitydata
                            </div>
                          facility;

                        echo <<<venue
                                <div class="Venues">
                                <h6 class=" mb-1">Venue</h6>
                                <span class='badge bg-light text-dark mb-1 text-wrap me-1 mb-1'> $eventdata[venue]</span>
                                </div>
                          venue;

                        echo <<<guest
                                 <div class="Venues mb-1">
                                  <h6 class="mb-1">Guest/Area</h6>
                                 <span class='badge bg-light text-dark mb-1 text-wrap me-1 mb-1'>  $eventdata[guest] </span>
                          guest;

                         //when site shutdown booknow btn hidden
                    
                          if(!$settingsr['shutdown'])
                          {    
                            $login = 0;
                            if (isset($_SESSION['login']) && $_SESSION['login'] == true){
                             $login = 1;
                             }
                            echo <<<book
                            <button  onclick='checkLoginToBook($login, " . $eventdata[id] . ")' class="btn w-100 text-white custom-bg  shadow-none mb-1">Book Now</button>
                            book;
             
                          }
                       

                        ?>
                    </div>

                </div>

                <div class="col-lg-9 col-md-12 px-4">

                    <?php

                    /*  $eventres = select("SELECT * FROM `event` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');
                      while ($eventdata = mysqli_fetch_assoc($eventres)) {

                          

                          
                          //get THumbnail of image
                          $eventthumb = EVENT_IMG_PATH . "thumbnail.jpg";
                          $thumbq = mysqli_query($con, "SELECT * FROM `eventimage`
                             WHERE `eventid`='$eventdata[id]' AND `thumb`='1' ");

                          if (mysqli_num_rows($thumbq) > 0) {
                              $thumbres = mysqli_fetch_assoc($thumbq);
                              $eventthumb = EVENT_IMG_PATH . $thumbres['image'];
                          }

                          //print event cart*************************************************************************************
                          echo <<<data
                              <div class='card mb-4 border-0 shadow'>
                              <div class="row g-0 p-3 align-items-center">
                                  <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                      <img src="$eventthumb" class="img-fluid rounded">
                                  </div>
                                 
                                   
                                  </div>
                                  <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                                      <h6 class="mb-4"> $eventdata[price]₹</h6>
                                      <a href="#" class="btn brn-sm w-100 text-white custom-bg  shadow-none mb-2">Book Now</a>
                                      <a href="eventdetail.php?id=$rowdata[id]" class="btn brn-sm w-100 btn-outline-dark shadow-none">More Details</a>
                                  </div>
                              </div>
                          </div>
                          data;


                      }
                     */
                    ?>

                </div>




            </div>

            <!-- trail div for design-->
        </div>

        <div class=" col-12 mt-4 px-4 ">
            <div class="mb-5">
                <h5>Description</h5>
                <p>
                    <?php
                    echo $eventdata['description']
                        ?>
                </p>
            </div>


            <div>
                <h5 class="mb-3">Reviews & Ratings</h5>
                <div>
                    <div class=" d-flex align-items-center mb-2">
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
        </div>


        <!--</div> because of div not flex proper it is coorect but i try-->
    </div>


    <!-- footer connection-->
    <?php require('inc/footer.php'); ?>






</body>

</html>