<div class="container-fluid bg-dark text-white p-3 d-flex align-items-center  justify-content-between  sticky-top">
    <h3 class="mb-0 h-font">ETwebsite</h3>
    <a href="logout.php" class="btn btn-light btn-sm">LOG OUT</a>
</div>

<!--if css not working then you try manully <div class="d-flex"id="dashboard-menu">-->
<!--SideBar-->
<div class="col-lg-2 bg-dark border-top border-3 border-secondary " id="dashboard-menu">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2 text-light">Admin Panel</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#admindropdown" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column  align-items-stretch mt-2 " id="admindropdown">
             <ul class="nav nav-pills flex-column">

                    <li class="nav-item">
                          <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                          <a class="nav-link text-white" href="userbooking.php">User BooKing</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#bookinglinks">
                        <span>Bookings</span>
                        <span><i class="bi bi-caret-down-fill"></i></span>
                        </button>

                        <div class="collapse show px-3 small mb-1" id="bookinglinks">
                          <ul class="nav nav-pills flex-column rounded border border-secondary">
                            
                            <li class="nav-item">
                                <a class="nav-link text-white" href="newbookings.php">New Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="refundbookings.php">Refund Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="bookingrecords.php">Booking Records</a>
                            </li>
                          </ul>
                          
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="users.php">Users<!--room--></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="userquery.php">userquery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="event.php">Events<!--room--></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="featurefacility.php">Feature & Facilities</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link text-white" href="Carousel.php">Carousel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="setting.php">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</div>