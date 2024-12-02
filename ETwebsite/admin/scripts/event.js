
let addeventform = document.getElementById('addeventform');

addeventform.addEventListener('submit', function (e) {
    e.preventDefault();
    addevent();

});

function addevent() {
    let data = new FormData();
    data.append('addevent', '');
    data.append('name', addeventform.elements['name'].value);
    data.append('venue', addeventform.elements['venue'].value);
    data.append('module', addeventform.elements['module'].value);
    data.append('guest', addeventform.elements['guest'].value);
    data.append('price', addeventform.elements['price'].value);
    data.append('desc', addeventform.elements['desc'].value);

    let feature = [];
    addeventform.elements['feature'].forEach(el => {
        if (el.checked) {
            feature.push(el.value);
        }
    });

    /*
    let facility = [];
    addeventform.elements['facility'].forEach(el => {
        if (el.checked) {
            facility.push(el.value);
        }
    });*/
    let facility = [];
    Array.from(addeventform.elements['facility']).forEach(el => {
        if (el.checked) {
            facility.push(el.value);
        }
    });


    data.append('feature', JSON.stringify(feature));
    data.append('facility', JSON.stringify(facility));

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/event.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById('addevent');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'new event added!');
            addeventform.reset();
            getevent();

        }
        else {
            alert('error', 'Server Down!');
        }
    }
    xhr.send(data);
}


function getevent() {
    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/event.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        document.getElementById('eventdata').innerHTML = this.responseText;

    }

    xhr.send('getevent');
}

//edit event modal

let editeventform = document.getElementById('editeventform');

function editdetail(id) {

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/event.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        // console.log(JSON.parse(this.responseText));
        let data = JSON.parse(this.responseText);

        editeventform.elements['name'].value = data.eventdata.name;
        editeventform.elements['venue'].value = data.eventdata.venue;
        editeventform.elements['module'].value = data.eventdata.module;
        editeventform.elements['guest'].value = data.eventdata.guest;
        editeventform.elements['price'].value = data.eventdata.price;
        editeventform.elements['desc'].value = data.eventdata.description;
        editeventform.elements['eventid'].value = data.eventdata.id;

        editeventform.elements['feature'].forEach(el => {
            if (data.feature.includes(Number(el.value))) {
                el.checked = true;
            }
        });

        /*
        editeventform.elements['facility'].forEach(el => {
            if (data.facility.includes(Number(el.value))) {
                el.checked = true;
            }
        });
        */
        Array.from(editeventform.elements['facility']).forEach(el => {
            if (data.facility.includes(Number(el.value))) {
                el.checked = true;
            }
        });




    }

    xhr.send('getevents=' + id);

}


editeventform.addEventListener('submit', function (e) {
    e.preventDefault();
    submiteditevent();
});

function submiteditevent() {
    let data = new FormData();

    data.append('editevent', '');
    data.append('eventid', editeventform.elements['eventid'].value);
    data.append('name', editeventform.elements['name'].value);
    data.append('venue', editeventform.elements['venue'].value);
    data.append('module', editeventform.elements['module'].value);
    data.append('guest', editeventform.elements['guest'].value);
    data.append('price', editeventform.elements['price'].value);
    data.append('desc', editeventform.elements['desc'].value);

    let feature = [];
    editeventform.elements['feature'].forEach(el => {
        if (el.checked) {
            feature.push(el.value);
        }
    });
    /*
        let facility = [];
        editeventform.elements['facility'].forEach(el => {
            if (el.checked) {
                facility.push(el.value);
            }
        });*/
    let facility = [];
    Array.from(editeventform.elements.facility).forEach(el => {
        if (el.checked) {
            facility.push(el.value);
        }
    });


    data.append('feature', JSON.stringify(feature));
    data.append('facility', JSON.stringify(facility));

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/event.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById('editevent');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'Event data Edited!');
            editeventform.reset();
            getevent();

        }
        else {
            alert('error', 'Server Down!');
        }
    }
    xhr.send(data);
}


function togglestatus(id, val) {

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/event.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'status toggled');
            getevent();
        }
        else {
            alert('error', 'server down')
        }

    }

    xhr.send('togglestatus=' + id + '&value=' + val);

}


let addimageform = document.getElementById('addimageform');

addimageform.addEventListener('submit', function (e) {
    e.preventDefault();
    addimage();

});

function addimage() {
    let data = new FormData();

    data.append('image', addimageform.elements['image'].files[0]);
    data.append('eventid', addimageform.elements['eventid'].value);
    data.append('addimage', '');


    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/event.php", true);

    xhr.onload = function () {

        if (this.responseText == 'inv_img') {
            alert('error', 'Only jpg and png images are allowed!', 'image-alert');
        }
        else if (this.responseText == 'inv_size') {
            alert('error', 'Image should be less than 2mb!', 'image-alert');
        }
        else if (this.responseText == 'upd_failed') {
            alert('error', 'Image upload failed Server Down!', 'image-alert');
        }
        else {
            alert('success', 'new Image added!', 'image-alert');
            eventimage(addimageform.elements['eventid'].value, document.querySelector("#eventimage .modal-title").innerText);
            addimageform.reset();


        }
    }
    xhr.send(data);
}


function eventimage(id, ename) {

    document.querySelector("#eventimage .modal-title").innerText = ename;
    addimageform.elements['eventid'].value = id;
    addimageform.elements['image'].value = '';

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/event.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        document.getElementById('eventimagedata').innerHTML = this.responseText;

    }

    xhr.send('geteventimage=' + id);
}


function remimage(imgid, eventid) {
    let data = new FormData();

    data.append('imageid', imgid);
    data.append('eventid', eventid);
    data.append('remimage', '');


    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/event.php", true);

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'Image Removed!!', 'image-alert');
            eventimage(eventid, document.querySelector("#eventimage .modal-title").innerText);
        }
        else {
            alert('error', 'Image remove Failed!!!', 'image-alert');
        }
    }
    xhr.send(data);

}

function thumbimage(imgid, eventid) {
    let data = new FormData();

    data.append('imageid', imgid);
    data.append('eventid', eventid);
    data.append('thumbimage', '');


    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/event.php", true);

    xhr.onload = function () {

        if (this.responseText == 1) {
            alert('success', 'Image Thumbnail Changed!!', 'image-alert');
            eventimage(eventid, document.querySelector("#eventimage .modal-title").innerText);
        }
        else {
            alert('error', 'Thumbnail update Failed!!!', 'image-alert');
        }
    }
    xhr.send(data);

}


function removeevent(eventid) {
    if (confirm("Are you Sure, You want to delete this Event?")) {
        let data = new FormData();
        data.append('eventid', eventid);
        data.append('removeevent', '');


        let xhr = new XMLHttpRequest(); //it is object
        xhr.open("POST", "ajax/event.php", true);

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success', 'Event Removed!!');
                getevent();
            }
            else {
                alert('error', 'event removal Failed!');
            }
        }
        xhr.send(data);
    }

}




window.onload = function () {
    getevent();
}


