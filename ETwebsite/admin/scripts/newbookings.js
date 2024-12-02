
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
    xhr.open("POST", "ajax/newbookings.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('tabledata').innerHTML = this.responseText;
    }

    xhr.send('getbookings&search=' + encodeURIComponent(search));
}


let assigneventform= document.getElementById('assigneventform')

function assignevent(id){
    assigneventform.elements['bookingid'].value=id;


}

assigneventform.addEventListener('submit',function(e){
    e.preventDefault();

    let data = new FormData();
    data.append('eventno', assigneventform.elements['eventno'].value);
    data.append('bookingid', assigneventform.elements['bookingid'].value);
    data.append('assignevent','');


    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/newbookings.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById('assignevent');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText==1){
           alert('success','Event Alloted! Booking Finalized');
           assignevent.reset();
           getbookings();
        }
        else
        {
            alert('error','serverdown!');
        }
       
    }
    xhr.send(data);
});


function cancelbooking(id){
    if (confirm("Are you Sure, You want to Cancel Booking?")) {
        let data = new FormData();
        data.append('bookingid', id);
        data.append('cancelbooking', '');


        let xhr = new XMLHttpRequest(); //it is object
        xhr.open("POST", "ajax/newbookings.php", true);

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success', 'Booking Canclled Sucessfully!!');
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


