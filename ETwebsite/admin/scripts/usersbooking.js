function deleteBooking(id) {
    if (confirm("Are you sure you want to delete this booking?")) {
        // Make an AJAX request to delete the booking
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_booking.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Booking deleted, refresh the table
                fetchBookings();
            } else {
                console.error('Failed to delete booking: ' + xhr.statusText);
            }
        };
        xhr.send('srno=' + id);
    }
}



 
/*
function fetchBookings() {
    // Make an AJAX request to fetch the bookings data
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_bookings.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var bookings = JSON.parse(xhr.responseText);
            var tableBody = document.getElementById('usersbooking');
            tableBody.innerHTML = ''; // Clear existing data

            // Loop through the bookings and add them to the table
            bookings.forEach(function (booking) {
                var row = '<tr>';
                row += '<td>' + booking.srno + '</td>';
                row += '<td>' + booking.name + '</td>';
                row += '<td>' + booking.pnum + '</td>';
                row += '<td>' + booking.event + '</td>';
                row += '<td>' + booking.venue + '</td>';
                row += '<td>' + booking.price + '</td>';
                row += '<td>' + booking.checkin + '</td>';
                row += '<td>' + booking.checkout + '</td>';
              //  row += '<td><button onclick="deleteBooking(' + booking.id + ')">Delete</button></td>';
               // row += '<td><button onclick="deleteBooking('<?php echo $booking['id']; ?>')">Delete</button></td>';
              //  row += '<td><i class="bi bi-trash-fill"><button onclick="deleteBooking(' + booking.srno + ')">Delete</button></i></td>';
             // row += '<td><i class="bi bi-trash-fill"></i><button onclick="deleteBooking(' + booking.srno + ')">Delete</button></td>';
             row += '<td><i class="bi bi-trash-fill"></i><button onclick="deleteBooking(' + booking.srno + ')" class="btn btn-danger">Delete</button></td>';


                row += '</tr>';
                tableBody.innerHTML += row;
            });
        } else {
            console.error('Failed to fetch bookings: ' + xhr.statusText);
        }
    };
    xhr.send();
}

window.onload = function () {
    fetchBookings();
};

*/

function fetchBookings() {
    // Make an AJAX request to fetch the bookings data
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_bookings.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var bookings = JSON.parse(xhr.responseText);
            var tableBody = document.getElementById('usersbooking');
            tableBody.innerHTML = ''; // Clear existing data

            // Loop through the bookings and add them to the table
            bookings.forEach(function (booking, index) {
                var row = '<tr>';
                row += '<td>' + (index + 1) + '</td>'; // Use index + 1 for sequential display
                row += '<td>' + booking.name + '</td>';
                row += '<td>' + booking.pnum + '</td>';
                row += '<td>' + booking.event + '</td>';
                row += '<td>' + booking.venue + '</td>';
                row += '<td>' + booking.price + '</td>';
                row += '<td>' + booking.checkin + '</td>';
                row += '<td>' + booking.checkout + '</td>';
                row += '<td><i class="bi bi-trash-fill"></i><button onclick="deleteBooking(' + booking.srno + ')" class="btn btn-danger">Delete</button></td>';
                row += '</tr>';
                tableBody.innerHTML += row;
            });
        } else {
            console.error('Failed to fetch bookings: ' + xhr.statusText);
        }
    };
    xhr.send();
}

window.onload = function () {
    fetchBookings();
};
