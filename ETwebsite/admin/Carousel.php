<?php
require('inc/essentials.php');
adminlogin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel -Carousel</title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Carousel</h3>

                <!-- Carousel section-->

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Images</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#carousel-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>
                        <div class="row" id="carouseldata">
                            <!--  <div class="col-md-3 mb-3">
                                <div class="card bg-dark text-white">
                                    <img src="../webImages/about/team.jpg" class="card-img">
                                    <div class="card-img-overlay">
                                        <button type="button" class="btn btn-danger btn-sm shadow-none">
                                            <i class="bi bi-trash "></i>Delete
                                        </button>
                                    </div>
                                    <p class="card-text text-center ">NIKHIL</p>
                                </div>
                            </div>
                              -->
                        </div>

                    </div>
                </div>

                <!-- Carousel Modal-->

                <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="carouselsform">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Image</h5>
                                </div>
                                <div class="modal-body">
                                   
                                    <div class=" mb-3">
                                        <label class="form-label fw-bold">Picture</label>
                                        <input type="file" name="carouselpicture" id="carouselpictureinp"
                                            accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="carouselpicture.value='' "
                                        class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require('inc/scripts.php') ?>

    <script src="scripts/carousel.js"></script>

</body>
</html>