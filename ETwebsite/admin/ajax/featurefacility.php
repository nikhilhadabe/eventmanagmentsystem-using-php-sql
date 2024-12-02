<?php

require('../inc/dbconfig.php'); //Emmet path abbrevation ../
require('../inc/essentials.php');
adminlogin();



if (isset($_POST['addfeature'])) {
    $frmdata = filteration($_POST);

    $q = "INSERT INTO `feature`(`name`) VALUES (?)";
    $values = [$frmdata['name']];
    $res = insert($q, $values, 's');
    echo $res;

}

if (isset($_POST['getfeatures'])) {

    $res = selectAll('feature');
    $i = 1;

    while ($row = mysqli_fetch_assoc($res)) {

        echo <<<data
            <tr>
              <td>$i</td>
              <td>$row[name]</td>
              <td>
              <button type="button" onclick="remfeature($row[id])" class="btn btn-danger btn-sm shadow-none">
                    <i class="bi bi-trash "></i>Delete
                </button>
              </td>
             </tr>      
        data;
        $i++;

    }
}

if (isset($_POST['remfeature'])) {

    $frmdata = filteration($_POST);
    $values = [$frmdata['remfeature']];

    $checkq = select('SELECT * FROM `eventfeature` WHERE `featureid`=?', [$frmdata['remfeature']], 'i');

    if (mysqli_num_rows($checkq)==0) {
        $q = "DELETE FROM `feature` WHERE `id`=?";
        $res = deleteOperation($q, $values, 'i');
        echo $res;
    } else {
        echo 'eventadded';
    }

}

/*
if (isset($_POST['addfacility'])) {
    $frmdata = filteration($_POST);

    $imgr = uploadImage($_FILES['icon'], FEATURE_FOLDER);

    if ($imgr == 'inv_img') {
        echo $imgr;
    } else if ($imgr == 'inv_size') {
        echo $imgr;
    } else if ($imgr == 'upd_failed') {
        echo $imgr;
    } else {
        $q = "INSERT INTO `facility`(`icon`,`name`, `description`) VALUES (?,?,?)";
        $values = [$imgr,$frmdata['name'],$frmdata['desc']];
        $res = insert($q, $values, 'sss');
        echo $res;

    }


}*/

if (isset($_POST['addfacility'])) {
    $frmdata = filteration($_POST);

    // Upload image
    $imgr = uploadSVGImage($_FILES['icon'], FACILITY_FOLDER);

    if ($imgr == 'inv_img') {
        echo "Invalid image format.";
    } else if ($imgr == 'inv_size') {
        echo "Image size is too large.";
    } else if ($imgr == 'upd_failed') {
        echo "Failed to upload image.";
    } else {
        // Insert facility details into the database
        $q = "INSERT INTO `facility`(`icon`,`name`, `description`) VALUES (?,?,?)";
        $values = [$imgr, $frmdata['name'], $frmdata['desc']];
        $res = insert($q, $values, 'sss');
        echo $res;
    }
}

if (isset($_POST['getfacility'])) {

    $res = selectAll('facility');
    $i = 1;
    $path = FACILITY_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {

        echo <<<data
            <tr>
              <td>$i</td>
              <td><img src="$path$row[icon]" style="width: 50px; height: 50px;"></td>
              <td>$row[name]</td>
              <td>$row[description]</td>
              <td>
              <button type="button" onclick="remfacility($row[id])" class="btn btn-danger btn-sm shadow-none">
                    <i class="bi bi-trash "></i>Delete
                </button>
              </td>
             </tr>      
        data;
        $i++;

    }
}

if (isset($_POST['remfacility'])) {

    $frmdata = filteration($_POST);
    $values = [$frmdata['remfacility']];

    $checkq = select('SELECT * FROM `eventfacility` WHERE `facilityid`=?', [$frmdata['remfacility']], 'i');

    if (mysqli_num_rows($checkq)==0) {
        $preq = "SELECT * FROM `facility` WHERE `id`=?";
        $res = select($preq, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if (deleteImage($img['icon'], FACILITY_FOLDER)) {
            $q = "DELETE FROM `facility` WHERE `id`=?";
            $res = deleteOperation($q, $values, 'i');
            echo $res;
        } else {
            echo 0;
        }

    } else {
        echo 'eventadded';
    }





}



?>