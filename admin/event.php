<?php
require('inc/essentials.php');
require('inc/dbconfig.php');
adminlogin();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel Events</title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Events</h3>



                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addevent">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>


                        <div class="table-responsive-lg" style="height:450px; overflow-y:scroll">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">srno</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Venue</th>
                                        <th scope="col">Module</th>
                                        <th scope="col">Guest</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="eventdata">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>




    <!-- Add Event Modal-->

    <div class="modal fade" id="addevent" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="addeventform" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Event</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" id="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Venue</label>
                                <input type="text" name="venue" id="venue" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">module</label>
                                <input type="text" name="module" id="module" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Guest (Max.)</label>
                                <input type="number" min="1" name="guest" id="guest" class="form-control shadow-none"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" min="1" name="price" id="price" class="form-control shadow-none"
                                    required>
                            </div>
                            <!-- <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Venue</label>
                            <input type="text" name="venue" id="featurenameinp" class="form-control shadow-none"
                                required>
                        </div>-->
                            <div class=" col-12 mb-3">
                                <label class="form-label fw-bold">Feature</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('feature');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                         <label>
                                            <input type='checkbox' name='feature' value='$opt[id]' class='form-check-input shadow-none'>
                                            $opt[name]
                                         </label>
                                        </div>
                                        ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class=" col-12 mb-3">
                                <label class="form-label fw-bold">Facility</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('facility');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                         <label>
                                            <input type='checkbox' name='facility' value='$opt[id]' class='form-check-input shadow-none'>
                                            $opt[name]
                                         </label>
                                        </div>
                                        ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold"> Description</label>
                                <textarea name="desc" rows="3" class="form-control shadow-none " required></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Event Modal-->

    <div class="modal fade" id="editevent" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editeventform" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Event</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" id="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Venue</label>
                                <input type="text" name="venue" id="venue" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">module</label>
                                <input type="text" name="module" id="module" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Guest (Max.)</label>
                                <input type="number" min="1" name="guest" id="guest" class="form-control shadow-none"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" min="1" name="price" id="price" class="form-control shadow-none"
                                    required>
                            </div>
                            <!-- <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Venue</label>
                            <input type="text" name="venue" id="featurenameinp" class="form-control shadow-none"
                                required>
                        </div>-->
                            <div class=" col-12 mb-3">
                                <label class="form-label fw-bold">Feature</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('feature');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                         <label>
                                            <input type='checkbox' name='feature' value='$opt[id]' class='form-check-input shadow-none'>
                                            $opt[name]
                                         </label>
                                        </div>
                                        ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class=" col-12 mb-3">
                                <label class="form-label fw-bold">Facility</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('facility');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                         <label>
                                            <input type='checkbox' name='facility' value='$opt[id]' class='form-check-input shadow-none'>
                                            $opt[name]
                                         </label>
                                        </div>
                                        ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold"> Description</label>
                                <textarea name="desc" rows="3" class="form-control shadow-none " required></textarea>

                            </div>
                            <input type="hidden" name="eventid">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Manage Event Image modal -->
    <div class="modal fade" id="eventimage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Event Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-alert"></div>
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="addimageform">
                            <label class="form-label fw-bold">Add Image</label>
                            <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg"
                                class="form-control shadow-none mb-3" required>
                            <button class="btn custom-bg text-white shadow-none">Add</button>
                            <input type="hidden" name="eventid">
                        </form>

                    </div>
                    <div class="table-responsive-lg" style="height:350px; overflow-y:scroll">
                        <table class="table table-hover border text-center">
                            <thead>
                                <tr class="bg-dark text-light sticky-top">
                                    <th scope="col" width="60%">Image</th>
                                    <th scope="col">ThumbNail</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="eventimagedata">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/scripts.php') ?>
    <script src="scripts/event.js"></script>



</body>

</html>