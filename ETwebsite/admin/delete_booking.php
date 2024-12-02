<?php
require('inc/dbconfig.php');

// Check if the ID parameter is set
if (isset($_POST['srno'])) {
    $id = $_POST['srno'];

    // Prepare a delete statement
    $query = "DELETE FROM bookings WHERE srno = ?";
    $stmt = mysqli_prepare($con, $query);

    // Check for errors in preparing the statement
    if (!$stmt) {
        die('Error preparing statement: ' . mysqli_error($con));
    }

    // Bind the ID parameter
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Check if any rows were affected
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Booking deleted successfully
            echo "Booking deleted successfully.";
        } else {
            // No rows were affected (booking not found)
            echo "Booking not found. srno: " . $id;
        }
    } else {
        // Failed to delete booking
        echo "Failed to delete booking: " . mysqli_error($con);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // ID parameter not set
    echo "ID parameter is missing.";
}
?>
