
/*

function getbookings(search='') {
    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/newbookings.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        document.getElementById('tabledata').innerHTML = this.responseText;

    }

    xhr.send('getbookings&search='+search);
}*/


function getbookings(search = '') {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/refundbookings.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('tabledata').innerHTML = this.responseText;
    }

    xhr.send('getbookings&search=' + encodeURIComponent(search));
}




function refundbooking(id){
    if (confirm("Are you Sure, You want to Refund Booking?")) {
        let data = new FormData();
        data.append('bookingid', id);
        data.append('refundbooking', '');


        let xhr = new XMLHttpRequest(); //it is object
        xhr.open("POST", "ajax/refundbookings.php", true);

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success', 'Refund Sucessfully!!');
                getbookings();
            }
            else {
                alert('error', 'Server Down!');
            }
        }
        xhr.send(data);
    }

}








window.onload = function () {
    getbookings();
}


