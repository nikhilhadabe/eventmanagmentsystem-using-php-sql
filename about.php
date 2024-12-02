<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DnyaniEvent about</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> <!-- tailwind css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> <!-- Swiper js -->
    <link rel="stylesheet" href="css\common.css">

    <?php require('inc/links.php'); ?>
    <style>
        .box {
            border-top-color: var(--teal) !important;
        }
    </style>

</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">About Us</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            Omnis itaque voluptatibus ab perferendis, ut vero quia fuga obcaecati magnam,
            accusamus debitis quos eum ipsum! Voluptates cumque vel quisquam nihil voluptatem?
        </p>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-2">
                <h3 class="mb-3">Nikhil Hadabe</h3>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Magnam quibusdam vel reiciendis ullam fugiat culpa nam eos vitae
                    autem dolorum, repellat, voluptates nisi ratione eaque mollitia quia
                    molestias at officiis.
                </p>
            </div>
            <div class="col-lg-5 col-md mb-4  order-lg-2 order-1">
                <img src="images1\img123.jpg" class="w-100">

            </div>
        </div>
        <!--mauli image-->
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-2 order-2">
                <h3 class="mb-3">Mauli Chauhan</h3>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Magnam quibusdam vel reiciendis ullam fugiat culpa nam eos vitae
                    autem dolorum, repellat, voluptates nisi ratione eaque mollitia quia
                    molestias at officiis.
                </p>
            </div>
            <div class="col-lg-5 col-md mb-4  order-lg-1 order-1">
                <img src="images1\img123.jpg" class="w-100">

            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img style="height: 40px;" src="webImages\about\hotel.svg" width="50px">
                    <h4 class="mt-3">100+ Events</h4>
                </div>

            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img style="height: 40px;" src="webImages\about\customers.svg" width="50px">
                    <h4 class="mt-3">200+ Customers</h4>
                </div>

            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img style="height: 40px;" src="webImages\about\rating.svg" width="50px">
                    <h4 class="mt-3">100+ Reviews</h4>
                </div>

            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img style="height: 40px;" src="webImages\about\staff.svg" width="50px">
                    <h4 class="mt-3">100+ staff</h4>
                </div>

            </div>
        </div>
    </div>

    <h3 class="my-5 fw-bold h-font text-center">Management Team</h3>

    <div class="container px-4">
        <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">

            <?php 
              $aboutr= selectAll('teamdetails');
              $path=ABOUT_IMG_PATH;

              while($row = mysqli_fetch_assoc($aboutr)){
                echo<<<data
                   <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                   <img src="$path$row[picture]" class="w-100">
                       <h5 class="mt-2"> $row[name] </h5>              
                   </div>
                data;
              }
            
            
            ?>
         <!-- it image div       <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="https://media.istockphoto.com/id/608627018/photo/the-best-tool-a-team-can-have-is-committed-leadership.webp?b=1&s=170667a&w=0&k=20&c=eoYkPvIyIE1qS4PWYWoIkhfKG9-c46JdQrM-t7hhvwA="
                                  class="w-100">
                    <h5 class="mt-2">Random name </h5>              
                </div>

                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="https://media.istockphoto.com/id/608627018/photo/the-best-tool-a-team-can-have-is-committed-leadership.webp?b=1&s=170667a&w=0&k=20&c=eoYkPvIyIE1qS4PWYWoIkhfKG9-c46JdQrM-t7hhvwA="
                                  class="w-100">
                    <h5 class="mt-2">Random name </h5>              
                </div>

                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="https://media.istockphoto.com/id/608627018/photo/the-best-tool-a-team-can-have-is-committed-leadership.webp?b=1&s=170667a&w=0&k=20&c=eoYkPvIyIE1qS4PWYWoIkhfKG9-c46JdQrM-t7hhvwA="
                                  class="w-100">
                    <h5 class="mt-2">Random name </h5>              
                </div>

                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="https://media.istockphoto.com/id/608627018/photo/the-best-tool-a-team-can-have-is-committed-leadership.webp?b=1&s=170667a&w=0&k=20&c=eoYkPvIyIE1qS4PWYWoIkhfKG9-c46JdQrM-t7hhvwA="
                                  class="w-100">
                    <h5 class="mt-2">Random name </h5>              
                </div>

                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="https://media.istockphoto.com/id/608627018/photo/the-best-tool-a-team-can-have-is-committed-leadership.webp?b=1&s=170667a&w=0&k=20&c=eoYkPvIyIE1qS4PWYWoIkhfKG9-c46JdQrM-t7hhvwA="
                                  class="w-100">
                    <h5 class="mt-2">Random name </h5>              
                </div>
            -->
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    

    <!-- footer connection-->
    <?php require('inc/footer.php'); ?>



    <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
  slidesPerView: 4,
  spaceBetween: 40,
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
</script>




</body>

</html>