<?php

 // require('connection.php');
  require('connection.php');



if(isset($_GET['email']) && isset($_GET['vcode']))
{
    $query="SELECT * FROM `registeruser` WHERE `email`='$_GET[email]' AND `verificationcode`='$_GET[vcode]' ";
    $result=mysqli_query($con,$query);
    if($result)
    {
        if(mysqli_num_rows($result)==1)
        {
            $resultfetch=mysqli_fetch_assoc($result);
            if($resultfetch['isverified']==0)
            {

                //$update="UPDATE `registeruser` SET `isverified`='1' WHERE `email`='$resulfetch[email]'";
               // $update="UPDATE `registeruser` SET `isverified`='1' WHERE `email`='$resultfetch[email]'";
              //  $update = "UPDATE `registeruser` SET `isverified`='1' WHERE `email`='" . $resultfetch['email'] . "'";
                $update = "UPDATE `registeruser` SET `isverified`='1' WHERE `email`='$resultfetch[email]'";
                
                if(mysqli_query($con,$update))
                {
                    echo"
                    <script>
                   alert(' Email Verification Successfull!');
                   window.location.href='index.php';
                   </script>
                   ";
                }
                else{
                    echo"
                    <script>
                   alert(' Cannot RUn Query');
                   window.location.href='index.php';
                   </script>
                   ";
                }
            }
            else{
                echo"
                <script>
               alert(' Email already Registered!');
               window.location.href='index.php';
               </script>
               ";
                
            }
        }
    }
    else{
        echo"
                  <script>
                 alert(' Cannot run query!');
                 window.location.href='index.php';
                 </script>
                 ";//9764756883
         }
}






?>