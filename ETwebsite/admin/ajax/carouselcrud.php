<?php

require('../inc/dbconfig.php'); //Emmet path abbrevation ../
require('../inc/essentials.php');
adminlogin();



if (isset($_POST['addimage'])) {

    $imgr = uploadImage($_FILES['picture'], CAROUSEL_FOLDER);

    if ($imgr == 'inv_img') {
        echo $imgr;
    } else if ($imgr == 'inv_size') {
        echo $imgr;
    } else if ($imgr == 'upd_failed') {
        echo $imgr;
    } else {
        $q = "INSERT INTO `carousel`(`image`) VALUES (?)";
        $values = [$imgr];
        $res = insert($q, $values, 's');
        echo $res;

    }


}

if (isset($_POST['getcarousel'])) {

    $res = selectAll('carousel');

    while ($row = mysqli_fetch_assoc($res)) {
        $path = CAROUSEL_IMG_PATH;
        echo <<<data
            <div class="col-md-3 mb-3">
            <div class="card bg-dark text-white">
                <img src="$path$row[image]" class="card-img">
                <div class="card-img-overlay">
                    <button type="button" onclick="remimage($row[srno])" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash "></i>Delete
                    </button>
                </div>
            </div>
            </div>
        data;

    }
}

if (isset($_POST['remimage'])) {

    $frmdata = filteration($_POST);
    $values = [$frmdata['remimage']];

    $preq = "SELECT * FROM `carousel` WHERE `srno`=?";
    $res = select($preq, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['image'], CAROUSEL_FOLDER)) {
        $q = "DELETE FROM `carousel` WHERE `srno`=?";
        $res = deleteOperation($q, $values, 'i');
        echo $res;
    } else {
        echo 0;
    }

}


?>