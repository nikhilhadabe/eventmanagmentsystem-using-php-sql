<?php

require('../inc/dbconfig.php'); //Emmet path abbrevation ../
require('../inc/essentials.php');
adminlogin();



//getbookings


if (isset($_POST['getbookings'])) 
{
   
   $frmdata= filteration($_POST);
   

/*
  $query="SELECT bo.*, bd.* FROM `bookingorder` bo
       INNER JOIN `bookingdetails` bd ON bo.bookingid=bd.bookingid
       WHERE (bo.orderid LIKE ? OR bd.pnum LIKE ? OR bd.username LIKE ?) AND
       (bo.bookingstatus=? AND bo.arrival = 0)  ORDER BY bo.bookingid ASC";  

    $res= select($query,["%$frmdata[search]%","%$frmdata[search]%","%$frmdata[search]%","booked",0],'sssss');*/

    $query = "SELECT bo.*, bd.* FROM `bookingorder` bo
          INNER JOIN `bookingdetails` bd ON bo.bookingid=bd.bookingid
          WHERE (bo.orderid LIKE ? OR bd.pnum LIKE ? OR bd.username LIKE ?) 
          AND bo.bookingstatus=? AND bo.arrival = ?  ORDER BY bo.bookingid ASC";

$res = select($query, ["%{$frmdata['search']}%", "%{$frmdata['search']}%", "%{$frmdata['search']}%", "booked",0], 'sssss');


    //if (!$res) {
     //   die(mysqli_error($con));
    //}
    $i=1;
    $tabledata="";
 
     if(mysqli_num_rows($res)==0){
        echo "<b>No data found!</b>";
        exit;
     }

    
    while($data = mysqli_fetch_assoc($res))
    {
        $date=date("d-m-Y",strtotime($data['datentime']));
        $checkin=date("d-m-Y",strtotime($data['checkin']));
        $checkout=date("d-m-Y",strtotime($data['checkout']));

        $tabledata .="
        <tr>
          <td>$i</td>
          <td>
            <span class='badge bg-primary'>
              Order ID: $data[orderid]
           </span>
          <br>
          <b>Name :</b> $data[username]
          <br>
          <b>PhoneNo :</b> $data[pnum] 
          </td>
          <td>
          <b> Event:</b> $data[eventname]
          <br>
          <b> Price:</b> $data[price]
          </td>
          <td>
          <b> Start Date:</b> $checkin
          <br>
          <b> Closed:</b> $checkout
          <br>
          <b> Paid:</b> $data[transamt]
          <br>
          <b> Date:</b> $date
          </td>
          <td>
          <button type='button' onclick='assignevent($data[bookingid])' class='btn text-white btn-sm fw-bold custom-bg shadow-none' data-bs-toggle='modal' data-bs-target='#assignevent'>
          <i class='bi bi-check2-square'>Assign Event</i>
          </button>
          <br>
          <br>
          <button type='button' onclick='cancelbooking($data[bookingid]) class='btn btn-outline-danger mt-2 btn-sm fw-bold  shadow-none' >
          <i class='bi bi-trash'>Cancel Booking</i>
          </button>
          </td>
        </tr>

        ";
        $i++;
    }

    echo $tabledata;
}






if (isset($_POST['assignevent'])) 
{
    $frmdata=filteration($_POST);

    $query="UPDATE `bookingorder` bo INNER JOIN `bookingdetails` bd
    ON bo.bookingid=bd.bookingid
    SET bp.arrival=?, bd.eventno=?
    WHERE bo.bookingid=?";

    $values = [1,$frmdata['eventno'],$frmdata['bookingid']];

    $res= update($query,$values,'isi');//it will update 2 events so it is will  retrun 2

    echo ($res==2) ? 1 : 0;
}







if (isset($_POST['cancelbooking'])) {

    $frmdata = filteration($_POST);

    $query="UPDATE `bookingorder` SET `bookingstatus`=?, `refund`=? WHERE `bookingid`=?";

    $values= ['cancelled',0,$frmdata['bookingid']];
    $res= update($query,$values,'sii');

    echo $res;


}



//if search code not solve from getbookings then solve form search code

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