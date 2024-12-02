<?php
require('admin/inc/dbconfig.php');
require('admin/inc/essentials.php');

date_default_timezone_set("Asia/Kolkata");

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $pnum = isset($_POST['pnum']) ? $_POST['pnum'] : '';
    $event = isset($_POST['event']) ? $_POST['event'] : ''; // Corrected variable name
    $venue = isset($_POST['venue']) ? $_POST['venue'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $checkin = isset($_POST['checkin']) ? $_POST['checkin'] : '';
    $checkout = isset($_POST['checkout']) ? $_POST['checkout'] : '';

    // Check if any of the fields are empty
    if (empty($name) || empty($pnum) || empty($event) || empty($venue) || empty($price) || empty($checkin) || empty($checkout)) {
        echo "Please fill out all fields.";
    } else {
        // Create a new insert query
        $query = "INSERT INTO `bookings` (`name`, `pnum`, `event`, `venue`, `price`, `checkin`, `checkout`) VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Prepare the values and datatypes
        $values = array($name, $pnum, $event, $venue, $price, $checkin, $checkout);
        $datatypes = "sssssss";

        // Insert the data
        $con = $GLOBALS['con'];
        if ($stmt = mysqli_prepare($con, $query)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                echo "<script>alert('Booking successfully inserted. Our team will contact you very soon.')</script>";
                // Redirect to index.php after alert
                echo '<meta http-equiv="refresh" content="0;URL=index.php">';
                exit(); // Optional: exit to prevent further execution
            } else {
                mysqli_stmt_close($stmt);
                echo "Failed to insert booking: " . mysqli_error($con);
            }
        } else {
            echo "Failed to prepare query: " . mysqli_error($con);
        }
    }
}
?>

<html>
<head>
    <title>Booking Form</title>
    <style>
        /* Your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
   
</head>
<body>
    <h1>Booking Form</h1>
    <form id="bookingForm" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="pnum">Phone Number:</label><br>
        <input type="text" id="pnum" name="pnum" required><br><br>

        <label for="event">Event:</label><br> <!-- Corrected input name -->
        <input type="text" id="event" name="event" required><br><br>

        <label for="venue">Venue:</label><br>
        <input type="text" id="venue" name="venue" required><br><br>

        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price" required><br><br>

        <label for="checkin">Check-in Date:</label><br>
        <input type="date" id="checkin" name="checkin" required><br><br>

        <label for="checkout">Check-out Date:</label><br>
        <input type="date" id="checkout" name="checkout" required><br><br>

        <input type="submit" value="Submit">
    </form>

    <script>
        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            var form = event.target;
            if (!form.checkValidity()) {
                // Form is not valid, prevent submission
                event.preventDefault();
                return false;
            }
        });
    </script>
</body>
</html>
