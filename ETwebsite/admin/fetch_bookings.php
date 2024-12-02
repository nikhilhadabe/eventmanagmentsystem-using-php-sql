<?php
require('inc/dbconfig.php');

// Fetch all bookings from the database
$query = "SELECT * FROM `bookings`";
$result = mysqli_query($GLOBALS['con'], $query);

if ($result) {
    // Prepare the booking data as an array
    $bookings = array();
    while ($row = mysqli_fetch_assoc($result)) {
        // Format the checkin and checkout dates
        $row['checkin'] = date('Y-m-d', strtotime($row['checkin']));
        $row['checkout'] = date('Y-m-d', strtotime($row['checkout']));
        
        $bookings[] = $row;
    }

    // Return the booking data as JSON
    echo json_encode($bookings);
} else {
    echo "Failed to fetch bookings: " . mysqli_error($con);
}
?>
