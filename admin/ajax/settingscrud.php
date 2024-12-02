<?php

require('../inc/dbconfig.php'); //Emmet path abbrevation ../
require('../inc/essentials.php');
adminlogin();


if (isset($_POST['getgeneral'])) {
    $q = "SELECT * FROM `settings` WHERE `srno` =? ";
    $values = [1];
    $res = select($q, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $jsondata = json_encode($data);
    echo "$jsondata";
}



if (isset($_POST['updgeneral'])) {
    $frmdata = filteration($_POST);

    $q = "UPDATE `settings` SET `sitetitle`=?, `siteabout`=? WHERE `srno`=?";
    $values = [$frmdata['sitetitle'], $frmdata['siteabout'], 1];
    $res = update($q, $values, "ssi");
    echo $res;
}


if (isset($_POST['updshutdown'])) {
    $frmdata = ($_POST['updshutdown'] == 0) ? 1 : 0;

    $q = "UPDATE `settings` SET `shutdown`=? WHERE `srno`=?";
    $values = [$frmdata, 1];
    $res = update($q, $values, "ii");
    echo $res;
}


if (isset($_POST['getcontacts'])) {
    $q = "SELECT * FROM `contactdetails` WHERE `srno` =? ";
    $values = [1];
    $res = select($q, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $jsondata = json_encode($data);
    echo "$jsondata";
}

if (isset($_POST['updcontacts'])) {
    $frmdata = filteration($_POST);

    $q = "UPDATE `contactdetails` SET `address`=?,`gmap`=?,`pn1`=?,`pn2`=?,`email`=?,`fb`=?,`insta`=?,`tw`=?,`iframe`=? WHERE `srno`=?";
    $values = [$frmdata['address'], $frmdata['gmap'], $frmdata['pn1'], $frmdata['pn2'], $frmdata['email'], $frmdata['fb'], $frmdata['insta'], $frmdata['tw'], $frmdata['iframe'], 1];
    $res = update($q, $values, "sssssssssi");
    echo $res;
}


if (isset($_POST['addmember'])) {
    $frmdata = filteration($_POST);

    $imgr = uploadImage($_FILES['picture'], ABOUT_FOLDER);

    if ($imgr == 'inv_img') {
        echo $imgr;
    } else if ($imgr == 'inv_size') {
        echo $imgr;
    } else if ($imgr == 'upd_failed') {
        echo $imgr;
    } else {
        $q = "INSERT INTO `teamdetails`(`name`, `picture`) VALUES (?,?)";
        $values = [$frmdata['name'], $imgr];
        $res = insert($q, $values, 'ss');
        echo $res;

    }


}

if (isset($_POST['getmembers'])) {

    $res = selectAll('teamdetails');

    while ($row = mysqli_fetch_assoc($res)) {
        $path = ABOUT_IMG_PATH;
        echo <<<data
           <div class="col-md-3 mb-3">
           <div class="card bg-dark text-white">
              <img src="$path$row[picture]" class="card-img">
            <div class="card-img-overlay">
                 <button type="button" onclick="remmembers($row[srno])" class="btn btn-danger btn-sm shadow-none">
                    <i class="bi bi-trash "></i>Delete
                </button>
            </div>
            <p class="card-text text-center "> $row[name]</p>
        </div>
          </div>
     data;

    }
}

if (isset($_POST['remmembers'])) {
    $frmdata = filteration($_POST);
    $values = [$frmdata['remmembers']];

    $preq = "SELECT * FROM `teamdetails` WHERE `srno`=?";
    $res = select($preq, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['picture'], ABOUT_FOLDER)) {
        $q = "DELETE FROM `teamdetails` WHERE `srno`=?";
        $res = deleteOperation($q, $values, 'i');
        echo $res;
    } else {
        echo 0;
    }

}


?>