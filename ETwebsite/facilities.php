<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> <!-- tailwind css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> <!-- Swiper js -->
    <link rel="stylesheet" href="css\common.css">

    <?php require('inc/links.php'); ?>
    <title><?php  echo $settingsr['sitetitle'] ?>-facilities</title>
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
        <h2 class="fw-bold h-font text-center">Our Facilities</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            Omnis itaque voluptatibus ab perferendis, ut vero quia fuga obcaecati magnam,
            accusamus debitis quos eum ipsum! Voluptates cumque vel quisquam nihil voluptatem?</p>

    </div>

    <div class="container">
        <div class="row">
            <?php
            $res = selectAll('facility');
            $path = FACILITY_IMG_PATH;

            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data
                        <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                            <div>
                                <img style=" height: 30px; weight: 40px;" src="$path$row[icon]" width="40px">

                                <h5 class="text-center">$row[name]</h5>
                            </div>
                            <p class="ms-3">$row[description]</p>
                        </div>
                    </div>
                data;
            }


            ?>
   <!--div store statically
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div>
                        <img style=" height: 30px; weight: 40px;" src="images1\wifi-logo.svg" width="40px">

                        <h5 class="text-center">wifi</h5>
                    </div>
                    <p class="ms-3">Lorem, ipsum dolor sit aibus deserunt,
                        magni sit a qui? Animi, eveniet.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div>
                        <img style=" height: 30px; weight: 40px;" src="images1\wifi-logo.svg" width="40px">

                        <h5 class="text-center">wifi</h5>
                    </div>
                    <p class="ms-3">Lorem, ipsum dolor sit aibus deserunt,
                        magni sit a qui? Animi, eveniet.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div>
                        <img style=" height: 30px; weight: 40px;" src="images1\wifi-logo.svg" width="40px">

                        <h5 class="text-center">wifi</h5>
                    </div>
                    <p class="ms-3">Lorem, ipsum dolor sit aibus deserunt,
                        magni sit a qui? Animi, eveniet.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div>
                        <img style=" height: 30px; weight: 40px;" src="images1\wifi-logo.svg" width="40px">

                        <h5 class="text-center">wifi</h5>
                    </div>
                    <p class="ms-3">Lorem, ipsum dolor sit aibus deserunt,
                        magni sit a qui? Animi, eveniet.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div>
                        <img style=" height: 30px; weight: 40px;" src="images1\wifi-logo.svg" width="40px">

                        <h5 class="text-center">wifi</h5>
                    </div>
                    <p class="ms-3">Lorem, ipsum dolor sit aibus deserunt,
                        magni sit a qui? Animi, eveniet.</p>
                </div>
            </div>
        -->   
        </div>
    </div>


    <!-- footer connection-->
    <?php require('inc/footer.php'); ?>






</body>

</html>