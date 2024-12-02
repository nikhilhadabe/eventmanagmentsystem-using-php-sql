
let carouselsform = document.getElementById('carouselsform');

let carouselpictureinp = document.getElementById('carouselpictureinp');






carouselsform.addEventListener('submit', function (e) {
    e.preventDefault();
    addimage();
});

function addimage() {

    let data = new FormData();

    data.append('picture', carouselpictureinp.files[0]);
    data.append('addimage', '');


    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/carouselcrud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById('carousel-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 'inv_img') {
            alert('error', 'Only jpg and pn images are allowed!');
        }
        else if (this.responseText == 'inv_size') {
            alert('error', 'Image should be less than 2mb!');
        }
        else if (this.responseText == 'upd_failed') {
            alert('error', 'Image upload failed Server Down!');
        }
        else {
            alert('success', 'new Image added!');
            carouselpictureinp.values = '';
            getcarousel();
        }
    }
    xhr.send(data);

}


function getcarousel() {

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/carouselcrud.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('carouseldata').innerHTML = this.responseText;

    }

    xhr.send('getcarousel');

}


function remimage(val) {

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/carouselcrud.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'member removed!')
            getcarousel();
        }
        else {
            alert('error', 'Server Down');
        }

    }
    xhr.send('remimage=' + val);


}



window.onload = function () {
    getcarousel();
}

