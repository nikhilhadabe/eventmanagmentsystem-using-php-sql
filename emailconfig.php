<?php

require('admin/inc/dbconfig.php');
require('admin/inc/essentials.php');

if(isset($_GET['emailconfirmation']))
{
    $data= filteration($_GET);

    $query=select("SELECT * FROM `usercred` WHERE `email`=? AND `token`=? LIMIT 1 ",
    [$data['email'], $data['token']],'ss');

    if(mysqli_num_rows($query)==1)
    {
        $fetch= mysqli_fetch_assoc($query);

        if($fetch['isverify']==1)
        {
            echo '<script>alert("Email Already Verified!")</script>';
        }
        else
        {
            $update=update("UPDATE `usercred` SET `isverify`= ? WHERE `id`=? ", [1, $fetch['id']],'ii');

            if($update)
            {
                echo '<script>alert("Email Verification Successful")</script>';
            }
            else
            {
                echo '<script>alert("Email Verification Failed! Server Down")</script>';
            }
        }
        header('Location: index.php');
        exit;
    }
    else{
        echo '<script>alert("Invalid Link!")</script>';
        header('Location: index.php');
        exit;
    }
}
?>
