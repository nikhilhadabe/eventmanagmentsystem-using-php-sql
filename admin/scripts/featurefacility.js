

let featureform = document.getElementById('featureform');
let facilityform = document.getElementById('facilityform');

featureform.addEventListener('submit', function (e) {
    e.preventDefault();
    addfeature();
});

function addfeature() {

    let data = new FormData();
    data.append('name', featureform.elements['featurename'].value);
    data.append('addfeature', '');


    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/featurefacility.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById('feature-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'new feature added!');
            featureform.elements['featurename'].value = '';
            getfeatures();

        }
        else {
            alert('error', 'Server Down!');
        }
    }
    xhr.send(data);

}


function getfeatures() {

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/featurefacility.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('featuredata').innerHTML = this.responseText;

    }

    xhr.send('getfeatures');

}


function remfeature(val) {

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/featurefacility.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText==1) {
            alert('success', 'feature removed!')
            getfeatures();
        }
        else if(this.responseText=='eventadded') {
            alert('error', 'Feature is added in Event!');
        }
        else {
            alert('error', 'Server Down ');
        }

    }
    xhr.send('remfeature=' + val);


}




//facility script



facilityform.addEventListener('submit', function (e) {
    e.preventDefault();
    addfacility();
});

function addfacility() {

    let data = new FormData();
    data.append('name', facilityform.elements['facilityname'].value);
    data.append('icon', facilityform.elements['facilityicon'].files[0]);
    data.append('desc', facilityform.elements['facilitydesc'].value);
    data.append('addfacility', '');


    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/featurefacility.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById('facility-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        if (this.responseText == 'inv_img') {
            alert('error', 'Only svg  images are allowed!');
        }
        else if (this.responseText == 'inv_size') {
            alert('error', 'Image should be less than 2mb!');
        }
        else if (this.responseText == 'upd_failed') {
            alert('error', 'Image upload failed Server Down!');
        }
        else {
            alert('success', 'new facility added!');
            facilityform.reset();
            getfacility();
        }
    }
    xhr.send(data);

}


function getfacility() {

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/featurefacility.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('facilitydata').innerHTML = this.responseText;

    }

    xhr.send('getfacility');

}



function remfacility(val) {

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/featurefacility.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'facilityremoved!')
            getfacility();
        }
        else if (this.responseText == 'eventadded') {
            alert('error', 'Feature is added in event!');

        }
        else {
            alert('error', 'Server Down');
        }

    }
    xhr.send('remfacility=' + val);


}



window.onload = function () {
    getfeatures();
    getfacility();
}




