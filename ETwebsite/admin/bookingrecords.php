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
    <title>Admin Pannel Booking records</title>
    <?php require ('inc/links.php') ?>
</head>

<body class="bg-light">

    <?php require ('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Booking records</h3>



                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <input type="text" id="searchinput" oninput="getbookings(this.value)"
                                class="form-control shadow-none w-25 ms-auto" placeholder="Type to search">
                        </div>


                        <div class="table-responsive">
                            <table class="table   table-border border " style="min-width: 1300px;">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">srno</th>
                                        <th scope="col">UserDetails</th>
                                        <th scope="col">EventDetails</th>
                                        <th scope="col">BookingDetails</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tabledata">

                                </tbody>
                            </table>
                        </div>

                        <nav >
                            <ul class="pagination mt-2" id="tablepagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>

                    </div>
                </div>



            </div>
        </div>
    </div>







    <?php require ('inc/scripts.php') ?>
    <script src="scripts/bookingrecords.js"></script>



</body>

</html>