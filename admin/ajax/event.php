<?php

require('../inc/dbconfig.php'); //Emmet path abbrevation ../
require('../inc/essentials.php');
adminlogin();


if (isset($_POST['addevent'])) {

    $feature = filteration(json_decode($_POST['feature']));
    $facility = filteration(json_decode($_POST['facility']));

    $frmdata = filteration($_POST);
    $flag = 0;

    $q1 = "INSERT INTO `event`(`name`, `venue`, `module`, `guest`, `price`, `description`) VALUES (?,?,?,?,?,?)";
    $values = [$frmdata['name'], $frmdata['venue'], $frmdata['module'], $frmdata['guest'], $frmdata['price'], $frmdata['desc']];

    if (insert($q1, $values, 'sssiis')) {
        $flag = 1;
    }

    $eventid = mysqli_insert_id($con);

    $q2 = "INSERT INTO `eventfacility`(`eventid`, `facilityid`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q2)) {
        foreach ($facility as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $eventid, $f);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot be prepared,insert');

    }

    $q3 = "INSERT INTO `eventfeature`(`eventid`, `featureid`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q3)) {
        foreach ($feature as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $eventid, $f);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot be prepared,insert');

    }

    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }



}
//getallevent
if (isset($_POST['getevent'])) {
    $res = select("SELECT * FROM `event` WHERE `removed`=?", [0], 'i');
    $i = 1;

    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {
        if ($row['status'] == 1) {
            $status = "<button onclick='togglestatus($row[id],0)' class='btn btn-dark btn-sm shadow-none'>active</button>";
        } else {
            $status = "<button onclick='togglestatus($row[id],1)' class='btn btn-warning btn-sm shadow-none'>Inactive</button>";
        }

        $data .= "
                            <tr class='align-middle'>
                                <td>$i</td>
                                <td>$row[name]</td>
                                <td>$row[venue]</td>
                                <td>$row[module]</td>
                                <td>$row[guest]</td>
                                <td>$row[price] Rs</td>
                                <td>$status</td>
                                <td>
                                <button type='button' onclick='editdetail($row[id])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#editevent'>
                                <i class='bi bi-pencil-square'></i> Edit
                                </button>
                                <button type='button'  onclick=\"eventimage($row[id],'$row[name]')\" class='btn btn-info shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#eventimage'>
                                <i class='bi bi-images'></i> 
                                </button>
                                <button type='button'  onclick=removeevent($row[id]) class='btn btn-danger shadow-none btn-sm' >
                                <i class='bi bi-trash'></i> 
                                </button>
                                </td>
                            </tr>
                            ";
        $i++;
    }
    echo $data;

}


//getevent
if (isset($_POST['getevents'])) {

    $frmdata = filteration($_POST);
    $res1 = select("SELECT * FROM `event` WHERE `id`=?", [$frmdata['getevents']], 'i');
    $res2 = select("SELECT * FROM `eventfeature` WHERE `eventid`=?", [$frmdata['getevents']], 'i');
    $res3 = select("SELECT * FROM `eventfacility` WHERE `eventid`=?", [$frmdata['getevents']], 'i');

    $eventdata = mysqli_fetch_assoc($res1);
    $feature = [];
    $facility = [];

    if (mysqli_num_rows($res2) > 0) {
        while ($row = mysqli_fetch_assoc($res2)) {
            array_push($feature, $row['featureid']);
        }

    }


    if (mysqli_num_rows($res3) > 0) {
        while ($row = mysqli_fetch_assoc($res3)) {
            array_push($facility, $row['facilityid']);
        }

    }

    $data = ["eventdata" => $eventdata, "feature" => $feature, "facility" => $facility];

    $data = json_encode($data);
    echo $data;


}

if (isset($_POST['editevent'])) {

    $feature = filteration(json_decode($_POST['feature']));
    $facility = filteration(json_decode($_POST['facility']));

    $frmdata = filteration($_POST);
    $flag = 0;

    $q1 = "UPDATE `event` SET `name`=?,`venue`=?,`module`=?,`guest`=?,`price`=?,`description`=? WHERE `id`=?";
    $values = [$frmdata['name'], $frmdata['venue'], $frmdata['module'], $frmdata['guest'], $frmdata['price'], $frmdata['desc'], $frmdata['eventid']];


    if (update($q1, $values, 'sssiisi')) {
        $flag = 1;

    }

    $delfeature = deleteOperation("DELETE FROM `eventfeature` WHERE `eventid`=?", [$frmdata['eventid']], 'i');
    $delfacility = deleteOperation("DELETE FROM `eventfacility` WHERE `eventid`=?", [$frmdata['eventid']], 'i');

    if ($delfeature && $delfacility) {
        $flag = 0;

    }


    $q2 = "INSERT INTO `eventfacility`(`eventid`, `facilityid`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q2)) {
        foreach ($facility as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $frmdata['eventid'], $f);
            mysqli_stmt_execute($stmt);
        }
        $flag = 1;
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot be prepared,insert');

    }

    $q3 = "INSERT INTO `eventfeature`(`eventid`, `featureid`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q3)) {
        foreach ($feature as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $frmdata['eventid'], $f);
            mysqli_stmt_execute($stmt);
        }
        $flag = 1;
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot be prepared,insert');

    }

    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }




}

if (isset($_POST['togglestatus'])) {

    $frmdata = filteration($_POST);

    $q = "UPDATE `event` SET `status`=? WHERE `id`=?";
    $v = [$frmdata['value'], $frmdata['togglestatus']];

    if (update($q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }

}


if (isset($_POST['addimage'])) {

    $frmdata = filteration($_POST);

    $imgr = uploadImage($_FILES['image'], EVENT_FOLDER);

    if ($imgr == 'inv_img') {
        echo $imgr;
    } else if ($imgr == 'inv_size') {
        echo $imgr;
    } else if ($imgr == 'upd_failed') {
        echo $imgr;
    } else {
        $q = "INSERT INTO `eventimage`(`eventid`, `image`) VALUES (?,?)";
        $values = [$frmdata['eventid'], $imgr];
        $res = insert($q, $values, 'is');
        echo $res;

    }


}

if (isset($_POST['geteventimage'])) {

    $frmdata = filteration($_POST);
    $res = select("SELECT * FROM `eventimage` WHERE `eventid`=?", [$frmdata['geteventimage']], 'i');

    $path = EVENT_IMG_PATH;


    while ($row = mysqli_fetch_assoc($res)) {
        if ($row['thumb'] == 1) {
            $thumbbtn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";

        } else {
            $thumbbtn = "  <button onclick='thumbimage($row[srno],$row[eventid])' class='btn btn-secondary shadow-none'>
        <i class='bi bi-check-lg'></i>
        </button>";

        }


        echo <<<data
        <tr class='align-middle'>
        <td> <img src='$path$row[image]' class='img-fluid'></td>
        <td> $thumbbtn</td>
        <td> 
        <button onclick='remimage($row[srno],$row[eventid])' class='btn btn-danger shadow-none'>
        <i class='bi bi-trash'></i>
        </button>
         </td>

        </tr>
    data;
    }

}


if (isset($_POST['remimage'])) {

    $frmdata = filteration($_POST);
    $values = [$frmdata['imageid'], $frmdata['eventid']];

    $preq = "SELECT * FROM `eventimage` WHERE `srno`=? AND `eventid`=? ";
    $res = select($preq, $values, 'ii');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['image'], EVENT_FOLDER)) {
        $q = "DELETE FROM `eventimage` WHERE `srno`=? AND `eventid`=? ";
        $res = deleteOperation($q, $values, 'ii');
        echo $res;
    } else {
        echo 0;
    }

}


if (isset($_POST['thumbimage'])) {

    $frmdata = filteration($_POST);

    $preq = "UPDATE `eventimage` SET `thumb`=? WHERE `eventid`=? ";
    $prev = [0, $frmdata['eventid']];
    $preres = update($preq, $prev, 'ii');


    $q = "UPDATE `eventimage` SET `thumb`=? WHERE `srno`=? AND `eventid`=? ";
    $v = [1, $frmdata['imageid'], $frmdata['eventid']];
    $res = update($q, $v, 'iii');

    echo $res;




}

if (isset($_POST['removeevent'])) {

    $frmdata = filteration($_POST);

    $res1 = select("SELECT * FROM `eventimage` WHERE `eventid`=?", [$frmdata['eventid']], 'i');

    while ($row = mysqli_fetch_assoc($res1)) {
        deleteImage($row['image'], EVENT_FOLDER);
    }

    $res2 = deleteOperation("DELETE FROM `eventimage` WHERE `eventid`=? ", [$frmdata['eventid']], 'i');
    $res3 = deleteOperation("DELETE FROM `eventfeature` WHERE `eventid`=? ", [$frmdata['eventid']], 'i');
    $res4 = deleteOperation("DELETE FROM `eventfacility` WHERE `eventid`=? ", [$frmdata['eventid']], 'i');
    $res5 = update("UPDATE `event` SET `removed`=?  WHERE `id`=? ", [1, $frmdata['eventid']], 'ii');


    if ($res2 || $res3 || $res4 || $res5) {
        echo 1;
    } else {
        echo 0;
    }







}




?>