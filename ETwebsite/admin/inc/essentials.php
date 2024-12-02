<?php

//frontend purpose data

define('SITE_URL', 'http://127.0.0.1/ETwebsite/');
define('ABOUT_IMG_PATH', SITE_URL . '/webImages/about/');
define('CAROUSEL_IMG_PATH', SITE_URL . '/webImages/carousel/');
define('FACILITY_IMG_PATH', SITE_URL . '/webImages/facility/');
define('EVENT_IMG_PATH', SITE_URL . '/webImages/events/');
define('USERS_IMG_PATH', SITE_URL . '/webImages/users/');



  
//backend upload process needs this data

define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/ETwebsite/webImages/');
define('ABOUT_FOLDER', 'about/');
define('CAROUSEL_FOLDER', 'carousel/');
define('FACILITY_FOLDER', 'facility/');
define('EVENT_FOLDER', 'events/');
define('USER_FOLDER', 'users/');

//php mailer mail and name send
//define('phpmaileremail',"hadabenikhil@gmail.com");
//define('phpmailername',"DnyaniEvent");

//Possible booking status value in db= pending, booked, paymentfailed, cancelled
//to configure paytm gateway check file 'project folder/inc/paytm/config_paytm.php'
 


function adminlogin()
{
    session_start();
    if (!(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin'] == true)) {

        echo "
        <script>
        window.location.href = 'index.php';
        </script>";
        exit;

    }
    //   session_regenerate_id(true);
}


function redirect($url)
{
    echo "
    <script>
    window.location.href = '$url';
    </script>";

}


function alert($type, $msg)
{
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    echo <<<alert
              <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
               <strong class="me-3"> $msg </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
     alert;
}

function uploadImage($image, $folder)
{
    //validation because double layer security
    $validamime = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    $imgmime = $image['type'];

    if (!in_array($imgmime, $validamime)) {
        return 'inv_img';  //invalid image mime or format

    } else if ($image['size'] / (3024 * 3024) > 2) {
        return 'inv_size'; //invalid grether than 2 mb
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".$ext";

        $imgpath = UPLOAD_IMAGE_PATH . $folder . $rname;
        if (move_uploaded_file($image['tmp_name'], $imgpath)) {
            return $rname;
        } else {
            return 'upd_failed image';
        }


    }


}

function deleteImage($image, $folder)
{
    if (unlink(UPLOAD_IMAGE_PATH . $folder . $image)) {
        return true;

    } else {
        return false;
    }
}

function uploadSVGImage($image, $folder)
{
    //validation because double layer security
    $validamime = ['image/svg+xml'];
    $imgmime = $image['type'];

    if (!in_array($imgmime, $validamime)) {
        return 'inv_img';  //invalid image mime or format

    } else if ($image['size'] / (3024 * 3024) > 2) {
        return 'inv_size'; //invalid grether than 2 mb
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".$ext";

        $imgpath = UPLOAD_IMAGE_PATH . $folder . $rname;
        if (move_uploaded_file($image['tmp_name'], $imgpath)) {
            return $rname;
        } else {
            return 'upd_failed image';
        }


    }


}
/*
function uploadUserImage($image)
{
        //validation because double layer security
        $validamime = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        $imgmime = $image['type'];

        if (!in_array($imgmime, $validamime)) 
        {
            return 'inv_img';  //invalid image mime or format
        } 
        else  {
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $rname = 'IMG_' . random_int(11111, 99999) . ".jpeg";

            $imgpath = UPLOAD_IMAGE_PATH . USER_FOLDER . $rname;
             
            if($ext =='png' || $ext =='PNG'){
               $img= imagecreatefrompng($image['tmp_name']);
            }
            else if($ext =='webp' || $ext =='webp'){
                $img= imagecreatefromwebp($image['tmp_name']);
            }else
            {
                $img= imagecreatefromjpeg($image['tmp_name']);
            }


            if (imagejpeg($img,$imgpath,90)) {
                return $rname;
            } else {
                return 'upd_failed image';
            }
        }

 }
*/

/*
function uploadUserImage($image)
{
    // Validation because double-layer security
    $validamime = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    $imgmime = $image['type'];

    if (!in_array($imgmime, $validamime)) {
        return 'inv_img';  // Invalid image mime or format
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".jpeg";

        $imgpath = UPLOAD_IMAGE_PATH . USER_FOLDER . $rname;

        // Load image based on its type
        if ($ext == 'png' || $ext == 'PNG') {
            $img = imagecreatefrompng($image['tmp_name']);
        } else if ($ext == 'webp' || $ext == 'webp') {
            $img = imagecreatefromwebp($image['tmp_name']);
        } else {
            $img = imagecreatefromjpeg($image['tmp_name']);
        }

        // Check if image loading was successful
        if (!$img) {
            return 'img_load_failed'; // Failed to load image
        }

        // Save the image
        if (imagejpeg($img, $imgpath, 90)) {
            return $rname;
        } else {
            return 'upd_failed'; // Failed to save image
        }
    }
}
*/
function uploadUserImage($image)
{
    // Validation because double-layer security
    $validamime = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    $imgmime = $image['type'];

    if (!in_array($imgmime, $validamime)) {
        return 'inv_img';  // Invalid image mime or format
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".jpeg";

        $imgpath = UPLOAD_IMAGE_PATH . USER_FOLDER . $rname;

        // Load image based on its type
        if ($ext == 'png' || $ext == 'PNG') {
            $img = imagecreatefrompng($image['tmp_name']);
        } else if ($ext == 'webp' || $ext == 'WEBP') {
            $img = imagecreatefromwebp($image['tmp_name']);
        } else {
            $img = imagecreatefromjpeg($image['tmp_name']);
        }

        // Check if image loading was successful
        if (!$img) {
            return 'img_load_failed'; // Failed to load image
        }

        // Save the image
        if (imagejpeg($img, $imgpath, 90)) {
            return $rname;
        } else {
            return 'upd_failed'; // Failed to save image
        }
    }
}





?>