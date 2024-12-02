<?php
require('inc/essentials.php');
require('inc/dbconfig.php');
adminlogin();

/*
if (isset($_GET['seen'])) {
    $frm_data = filteration($_GET);

    if ($frm_data['seen'] == 'all') {
        $q = "UPDATE userquery SET seen=?";
        $values = [1];
        if (update($q, $values, 'i')) {
            alert('success', 'Marked  all as Read!');
        } else {
            alert('error', 'Operation Failed!');
        }
    } else {
        $q = "UPDATE userquery SET seen=?  WHERE srno=?";
        $values = [1, $frm_data['seen']];
        if (update($q, $values, 'ii')) {
            alert('success', 'Marked as Read!');
        } else {
            alert('error', 'Operation Failed!');
        }

    }
}


if (isset($_GET['del'])) {
    $frm_data = filteration($_GET);

    if ($frm_data['del'] == 'all') {
        $q = "DELETE FROM userquery";
        if (mysqli_query($con, $q)) {
            alert('success', ' All Data Deleted!');
        } else {
            alert('error', 'Operation Failed!');
        }


    } else {
        $q = "DELETE FROM userquery WHERE srno=?";
        $values = [$frm_data['del']];
        if (deleteOperation($q, $values, 'i')) {
            alert('success', 'Data Deleted!');
        } else {
            alert('error', 'Operation Failed!');
        }

    }
}
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel Feature&Facility</title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Feature & Facility</h3>



                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Features</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#feature-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>


                        <div class="table-responsive-md" style="height:350px; overflow-y:scroll">
                            <table class="table table-hover border">
                                <thead class="">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">srno</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="featuredata">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

<!--facility-->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Facilities</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#facility-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>


                        <div class="table-responsive-md" style="height:350px; overflow-y:scroll">
                            <table class="table table-hover border">
                                <thead >
                                    <tr class="bg-dark text-light">
                                        <th scope="col">srno</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="facilitydata">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>




    <!-- feature Modal-->

    <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="featureform">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Feature</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="featurename" id="featurenameinp" class="form-control shadow-none"
                                required>
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


    <!--facility modal-->


    <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facilityform">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Facility</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold"> Facility Name</label>
                            <input type="text" name="facilityname" id="facilitynameinp" class="form-control shadow-none"
                                required>
                        </div>

                        <div class=" mb-3">
                            <label class="form-label fw-bold">Icon</label>
                            <input type="file" name="facilityicon" id="facilityiconinp" accept=".svg"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-12 p-0 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="facilitydesc" class="form-control shadow-none" rows="3"></textarea>
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

    <?php require('inc/scripts.php') ?>

   <!--   <script>

        let featureform = document.getElementById('featureform');
        let facilityform = document.getElementById('facilityform');

        featureform.addEventListener('submit', function (e) {
            e.preventDefault();
            addfeature();
        });

        function addfeature() {

            let data = new FormData();
            data.append('name', featureform.elements['featurename'].value);
            data.append('addfeature', '');


            let xhr = new XMLHttpRequest(); //it is object
            xhr.open("POST", "ajax/featurefacility.php", true);

            xhr.onload = function () {
                var myModal = document.getElementById('feature-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert('success', 'new feature added!');
                    featureform.elements['featurename'].value = '';
                    getfeatures();

                }
                else {
                    alert('error', 'Server Down!');
                }
            }
            xhr.send(data);

        }


        function getfeatures() {

            let xhr = new XMLHttpRequest(); //it is object
            xhr.open("POST", "ajax/featurefacility.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('featuredata').innerHTML = this.responseText;

            }

            xhr.send('getfeatures');

        }



        function remfeature(val) {

            let xhr = new XMLHttpRequest(); //it is object
            xhr.open("POST", "ajax/featurefacility.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (this.responseText == 1) {
                    alert('success', 'feature removed!')
                    getfeatures();
                }
                else if (this.responseText == 'eventadded') {
                    alert('error', 'Feature is added in room!');

                }
                else {
                    alert('error', 'Server Down');
                }

            }
            xhr.send('remfeature=' + val);


        }



        //facility script



        facilityform.addEventListener('submit', function (e) {
            e.preventDefault();
            addfacility();
        });

        function addfacility() {

            let data = new FormData();
            data.append('name', facilityform.elements['facilityname'].value);
            data.append('icon', facilityform.elements['facilityicon'].files[0]);
            data.append('desc', facilityform.elements['facilitydesc'].value);
            data.append('addfacility', '');


            let xhr = new XMLHttpRequest(); //it is object
            xhr.open("POST", "ajax/featurefacility.php", true);

            xhr.onload = function () {
                var myModal = document.getElementById('facility-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                if (this.responseText == 'inv_img') {
                    alert('error', 'Only svg  images are allowed!');
                }
                else if (this.responseText == 'inv_size') {
                    alert('error', 'Image should be less than 2mb!');
                }
                else if (this.responseText == 'upd_failed') {
                    alert('error', 'Image upload failed Server Down!');
                }
                else {
                    alert('success', 'new facility added!');
                   facilityform.reset();
                    getfacility();
                }
            }
            xhr.send(data);

        }


        function getfacility() {

            let xhr = new XMLHttpRequest(); //it is object
            xhr.open("POST", "ajax/featurefacility.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('facilitydata').innerHTML = this.responseText;

            }

            xhr.send('getfacility');

        }



        function remfacility(val) {

            let xhr = new XMLHttpRequest(); //it is object
            xhr.open("POST", "ajax/featurefacility.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (this.responseText == 1) {
                    alert('success', 'facilityremoved!')
                    getfacility();
                }
                else if (this.responseText == 'eventadded') {
                    alert('error', 'Feature is added in event!');

                }
                else {
                    alert('error', 'Server Down');
                }

            }
            xhr.send('remfacility=' + val);


        }

        

        window.onload = function () {
            getfeatures();
            getfacility();
        }


    </script>
    -->
    <script src="scripts/featurefacility.js"></script>


</body>

</html>