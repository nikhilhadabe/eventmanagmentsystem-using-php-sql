<?php
require ('inc/essentials.php');
require ('inc/dbconfig.php');
adminlogin();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel UsersBOOKING</title>
    <?php require ('inc/links.php') ?>
</head>

<body class="bg-light">

    <?php require ('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">USER BOOKING</h3>



                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <input type="text" oninput="searchuser(this.value)"
                                class="form-control shadow-none w-25 ms-auto" placeholder="Type to search">
                        </div>


                        <div class="table-responsive">
                            <table class="table table-hover border text-center" style="min-width: 1300px;">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">srno</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Event</th>
                                        <th scope="col">venue</th>
                                        <th scope="col">price</th>
                                        <th scope="col">checkindate</th>
                                        <th scope="col">checkoutdate</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="usersbooking">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>




 <?php require ('inc/scripts.php') ?>
    <script src="scripts/usersbooking.js"></script>
    

    



</body>

</html>