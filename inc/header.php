




<!--Navbar-->
<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5m fw-bold fs-3 h-font" href="index.php"><?php  echo $settingsr['sitetitle'] ?></a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link me-2"  href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="events.php">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="facilities.php">facility</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="contactus.php">contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">about us</a>
                </li>
            </ul>
            <div class="d-flex">
                <!--  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>-->

                <?php
                   if(isset($_SESSION['login']) && $_SESSION['login']==true)
                   {
                    $path= USERS_IMG_PATH;
                    echo<<<data
                     <div class="btn-group">
                    <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <img src="$path$_SESSION[upic]" style="width: 25px;  height: 25px; " class="me-1">
                           $_SESSION[uname]
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="profile.php">profile</a></li>
                        <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                        <li><a class="dropdown-item" href="logout.php">LogOut</a></li>
                       
                    </ul>
                    </div>

                    data;
                   }
                   else
                   {
                    echo<<<data
                     <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Login
                       </button>
                     <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"data-bs-target="#RegisterModal">
                        Register
                    </button>
                    data;
                   }
                ?>        
               
            </div>
        </div>
    </div>
</nav>

<!--loginmodal-->

<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="loginform">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i>User Login
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email / Mobile</label>
                        <input type="text" name="emailmob" required class="form-control shadow-none">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="pass" required  class="form-control shadow-none">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">Login </button>
                        <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2 p-0" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#forgotModal">
                        Forgot Password
                    </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<!--register modal-->
<div class="modal fade" id="RegisterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <form id="registerform">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i>User Registration
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                        Note: Your details must match with your ID(adhar,pan, driving license, etc.)
                        that will be required during check-in.
                    </span>


                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label"> Name</label>
                                <input name="name" type="text" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label"> Email</label>
                                <input  name="email" type="email" class="form-control shadow-none"required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label"> Phone Number</label>
                                <input name="pnum" type="number" class="form-control shadow-none"required>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Picture</label>
                                <input name="profile" type="file" class="form-control shadow-none"required>
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label  class="form-label">Address</label>
                               <!-- <input type="text" class="form-control shadow-none">-->
                                <textarea name="address" class="form-control shadow-none" rows="1"required></textarea>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Pincode</label>
                                <input  name="pincode" type="number" class="form-control shadow-none"required>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input  name="dob" type="date" class="form-control shadow-none"required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <input name="pass" type="Password" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none"required>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input  name="cpass" type="password" class="form-control shadow-none"required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-1">
                        <button type="submit" class="btn btn-dark shadow-none">Register </button>

                    </div>





                    <!--    <div class="mb-3">
                   <label  class="form-label">Email address</label>
                   <input type="email" class="form-control shadow-none">
                 </div>
                 <div class="mb-4">
                   <label  class="form-label">Password</label>
                   <input type="password" class="form-control shadow-none">
                 </div>
                 <div class="d-flex align-items-center justify-content-between mb-2">
                    <button type="submit"  class="btn btn-dark shadow-none">Login </button>
                    <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forget Password</a>
                 </div>-->
                </div>
            </form>
        </div>
    </div>
</div>





<!--forgotmodal-->

<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="forgotform">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i> Forgot Password
                    </h5>
                </div>
                <div class="modal-body">
                    <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                        Note: A link will be sent to your email to reset your password
                    </span>
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" required class="form-control shadow-none">
                    </div>
                    <div class=" mb-2 text-end">
                       
                        <button type="button" class="btn shadow-none me-lg-3 me-2 p-0" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#loginModal">
                        Cancel
                      </button>
                    <button type="submit" class="btn btn-dark shadow-none">Send Link </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>