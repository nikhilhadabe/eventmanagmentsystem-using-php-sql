<?php

require('../inc/dbconfig.php'); //Emmet path abbrevation ../
require('../inc/essentials.php');
adminlogin();



//getallevent
if (isset($_POST['getusers'])) 
{
    $res = selectAll('usercred');
    $i = 1;
    $path=USERS_IMG_PATH;

    $data = "";

    while ($row = mysqli_fetch_assoc($res))
     {

        $delbtn=" <button type='button'  onclick=removeuser($row[id]) class='btn btn-danger shadow-none btn-sm' >
                 <i class='bi bi-trash'></i> 
         </button>";

        $verified="<span class='badge bg-warning '><i class='bi bi-x-lg'></i></span>";

        if($row['isverify'])
        {
            $verified="<span class='badge bg-success '><i class='bi bi-check-lg'></i></span>";
            $delbtn="";
        }

        $status = "<button onclick='togglestatus($row[id],0)' class='btn btn-dark btn-sm shadow-none'> active </button>";

        if(!$row['status'])
        {
            $status = "<button onclick='togglestatus($row[id],1)' class='btn btn-danger btn-sm shadow-none'> Inactive </button>";
        }

        $date= date("d-m-Y",strtotime($row['datentime']));

        $data .= "
              <tr>
              <td>$i </td>
              <td>
               <img src='$path$row[profile]' style='width: 50px; height: 50px;'>
               <br>
                $row[name]</td>

              <td>$row[email]</td>
              <td>$row[pnum]</td>
              <td>$row[address]  $row[pincode]</td>
              <td>$row[dob]</td>
              <td>$verified </td>
              <td> $status </td>
              <td> $date </td>
              <td> $delbtn </td>
              </tr>
                           
         ";

        $i++;
    }
    echo $data;

}


if (isset($_POST['togglestatus'])) {

    $frmdata = filteration($_POST);

    $q = "UPDATE `usercred` SET `status`=? WHERE `id`=?";
    $v = [$frmdata['value'], $frmdata['togglestatus']];

    if (update($q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }

}


if (isset($_POST['removeuser'])) {

    $frmdata = filteration($_POST);

    $res = update("DELETE FROM  `usercred`  WHERE `id`=?  AND `isverify`=?   ", [$frmdata['userid'],0], 'ii');

    if ($res) {
        echo 1;
    } else {
        echo 0;
    }


}

if (isset($_POST['searchuser'])) 
{
    $frm_data=filteration($_POST);

    $query="SELECT * FROM `usercred` WHERE `name` LIKE ? ";
    $res = select($query,["%$frm_data[name]%"],'s');
    $i = 1;
    $path=USERS_IMG_PATH;

    $data = "";

    while ($row = mysqli_fetch_assoc($res))
     {

        $delbtn=" <button type='button'  onclick=removeuser($row[id]) class='btn btn-danger shadow-none btn-sm' >
                 <i class='bi bi-trash'></i> 
         </button>";

        $verified="<span class='badge bg-warning '><i class='bi bi-x-lg'></i></span>";

        if($row['isverify'])
        {
            $verified="<span class='badge bg-success '><i class='bi bi-check-lg'></i></span>";
            $delbtn="";
        }

        $status = "<button onclick='togglestatus($row[id],0)' class='btn btn-dark btn-sm shadow-none'> active </button>";

        if(!$row['status'])
        {
            $status = "<button onclick='togglestatus($row[id],1)' class='btn btn-danger btn-sm shadow-none'> Inactive </button>";
        }

        $date= date("d-m-Y",strtotime($row['datentime']));

        $data .= "
              <tr>
              <td>$i </td>
              <td>
               <img src='$path$row[profile]' style='width: 50px; height: 50px;'>
               <br>
                $row[name]</td>

              <td>$row[email]</td>
              <td>$row[pnum]</td>
              <td>$row[address]  $row[pincode]</td>
              <td>$row[dob]</td>
              <td>$verified </td>
              <td> $status </td>
              <td> $date </td>
              <td> $delbtn </td>
              </tr>
                           
         ";

        $i++;
    }
    echo $data;

}




?>