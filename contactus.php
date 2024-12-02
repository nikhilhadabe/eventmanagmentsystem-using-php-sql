<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> <!-- tailwind css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> <!-- Swiper js -->
    <link rel="stylesheet" href="css\common.css">

    <?php require('inc/links.php'); ?>
    <title><?php  echo $settingsr['sitetitle'] ?>-Contact Us</title>

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
        <h2 class="fw-bold h-font text-center">Contact Us</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            Omnis itaque voluptatibus ab perferendis, ut vero quia fuga obcaecati magnam,
            accusamus debitis quos eum ipsum! Voluptates cumque vel quisquam nihil voluptatem?</p>

    </div>

    

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 ">
                    <iframe src="<?php echo $contactr['iframe']  ?>"
                        class="w-100 rounded" height="320"></iframe>

                    <h5 class="mt-1">Address</h5>
                    <a href="<?php echo $contactr['gmap']  ?>" target="_blank"
                        class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i> <?php echo $contactr['address']  ?>
                    </a>
                    <h5 class="mt-3">Call Us</h5>
                    <a href="tel: <?php echo $contactr['pn1']  ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +<?php echo $contactr['pn1']  ?></a>
                    <br>
                    <?php
                     if($contactr['pn2']!='')
                     {
                        echo<<<data
                           <a href="tel: +$contactr[pn2]" class="d-inline-block mb-2 text-decoration-none text-dark">
                           <i class="bi bi-telephone-fill"></i> +$contactr[pn2]</a>
                        data;
                     }
                    ?>

                   <!-- <a href="tel: 9021388541" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +919021388541</a>  -->
                    <h5 class="mt-4">E-mail</h5>
                    <a href="mailto: <?php echo $contactr['email']  ?>"
                        class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-envelope"></i> <?php echo $contactr['email']  ?>
                    </a>

                    <h5 class="mt-4">Follow Us</h5>
                    <?php
                    if ($contactr['tw'] != '') {
                        echo <<<data
                            <a href="$contactr[tw]" class="d-inline-block mb-3 text-dark fs-5 me-2">
                            <i class="bi bi-twitter-x me-1"></i>
                            </a>
                        data;
                    }
                    ?>
                   <!-- <a href="#" class="d-inline-block mb-3 text-dark fs-5 me-2">
                        <i class="bi bi-twitter-x me-1"></i>
                    </a>-->
                    <a href="<?php echo $contactr['fb']  ?>" class="d-inline-block mb-3 text-dark fs-5 me-2">
                        <i class="bi bi-facebook me-1"></i>
                    </a>

                    <a href="<?php echo $contactr['insta']  ?>" class="d-inline-block mb-3 text-dark fs-5">
                        <i class="bi bi-instagram me-1"></i>
                    </a>
                    <br>
                </div>
            </div>
            <div class="col-lg-6 col-md-6  px-4">
                <div class="bg-white rounded shadow p-4 ">
                    <form method="POST">

                        <h5>Send a Message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input   name="name" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Email</label>
                            <input  name="email" required type="email" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input name="subject" required  type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Message</label>
                            <textarea  name="message" required class="form-control shadow-none" rows="5" style="resize:none;"></textarea>
                        </div>
                        <button type="submit" name="send" class="btn text-white custom-bg mt-3">SEND </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   <?php 
    if(isset($_POST['send']))
    {
        $frmdata = filteration($_POST);

        $q="INSERT INTO `userquery`( `name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values=[$frmdata['name'],$frmdata['email'],$frmdata['subject'],$frmdata['message']];

        $res=insert($q,$values,'ssss');
        if($res==1)
        {
            alert('success','mail sent!');
        }
        else{
            alert('error','Server Down! Try again later.');
        }

    }
   
   ?>

    <!-- footer connection-->
    <?php require('inc/footer.php'); ?>


</body>

</html>