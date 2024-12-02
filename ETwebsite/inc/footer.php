<div class="container-fluid  bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3 class="h-font fw-bold fs-3">
                <?php echo $settingsr['sitetitle'] ?>
            </h3>
            <p>
                <?php echo $settingsr['siteabout'] ?>

            </p>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Links</h5>
            <a href="index.php" class="d-inline mb-2 text-decoration-none">Home</a><br>
            <a href="events.php" class="d-inline mb-2 text-decoration-none">Events</a><br>
            <a href="facilities.php" class="d-inline mb-2 text-decoration-none">facilities</a><br>
            <a href="contactus.php" class="d-inline mb-2 text-decoration-none">ContactUs</a><br>
            <a href="about.php" class="d-inline mb-2 text-decoration-none">About</a>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Follow Us</h5><br>
            <?php
            if ($contactr['tw'] != '') {
                echo <<<data
                          <a href=" $contactr[tw]" class="d-inline-block mb-2 text-dark text-decoration-none mb-2"> <i
                           class="bi bi-twitter-x me-1"></i> Twitter-x </a><br>
                        data;
            }
            ?>
            <!-- <a href="<?php //echo $contactr['tw']    ?>" class="d-inline-block mb-2 text-dark text-decoration-none mb-2"> <i
                    class="bi bi-twitter-x me-1"></i> Twitter-x </a><br> -->
            <a href="<?php echo $contactr['fb'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none mb-2"> <i
                    class="bi bi-facebook me-1"></i> facebook </a><br>
            <a href="<?php echo $contactr['insta'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none"> <i
                    class="bi bi-instagram me-1"></i>
                instagram</a>


        </div>
    </div>
</div>


<h6 class="text-center  bg-dark text-white p-3 m-0">Designed & developed by Nikhil Hadabe</h6>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

<!--
<script>

    /*    
       function alert(type, msg,position='body') {
       let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
       let element = document.createElement('div');
       element.innerHTML = `
                 <div class="alert ${bs_class} alert-dismissible fade show " role="alert">
                  <strong class="me-3"> ${msg} </strong>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
           `;
           if(position=='body'){
             document.body.append(element);
             element.classList.add('custom-alert');
   
           }else{
             document.getElementById(position).appendChild(element);
   
           }
          setTimeout(remAlert,2000);
     }
   
     function remAlert() {
       document.getElementsByClassName('alert')[0].remove();
   
     }*/
    function alert(type, msg, position = 'body') {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
        if (position == 'body') {
            document.body.append(element);
            element.classList.add('custom-alert');
        } else {
            let targetElement = document.getElementById(position);
            if (targetElement) {
                targetElement.appendChild(element);
            } else {
                console.error(`Element with id '${position}' not found.`);
                return;
            }
        }
        setTimeout(() => remAlert(element), 2000);
    }

    function remAlert(element) {
        element.remove();
    }

    function setActive() {
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');

        for (i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let filename = file.split('.')[0];

            if (document.location.href.indexOf(filename) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }

    
    let registerform = document.getElementById('registerform');

    registerform.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();

        data.append('name', registerform.elements['name'].value);
        data.append('email', registerform.elements['email'].value);
        data.append('pnum', registerform.elements['pnum'].value);
        data.append('address', registerform.elements['address'].value);
        data.append('pincode', registerform.elements['pincode'].value);
        data.append('dob', registerform.elements['dob'].value);
        data.append('pass', registerform.elements['pass'].value);
        data.append('cpass', registerform.elements['cpass'].value);
        data.append('profile', registerform.elements['profile'].files[0]);
        data.append('register', '');

        var myModal = document.getElementById('RegisterModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest(); //it is object
        xhr.open("POST", "ajax/loginregister.php", true);

        xhr.onload = function () {
            if (this.responseText == 'pass-MisMatch') {
                alert('error', 'password mismatch');
            }
            else if (this.responseText == 'email_already') {
                alert('error', 'Email is already');
            }
            else if (this.responseText == 'Phone_already') {
                alert('error', 'phone is already');
            }
            else if (this.responseText == 'inv_img') {
                alert('error', 'Only jpeg,webp & png upload');
            }
            else if (this.responseText == 'upd_failed') {
                alert('error', 'image failed');
            }
            else if (this.responseText == 'mail_failed') {
                alert('error', 'canot send mail');
            }
            else if (this.responseText == 'ins_failed') {
                alert('error', 'REgistration failed');
            }
            else {
                alert('success', "Resgistration Successful. Confirmation link sent!")
            }
        }

        xhr.send(data);
    });



    setActive();
</script>
-->
<script>
     

    function alert(type, msg, position = 'body') {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
    <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
        <strong class="me-3">${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
`;
    if (position == 'body') {
        document.body.append(element);
        element.classList.add('custom-alert');
    } else {
        let targetElement = document.getElementById(position);
        if (targetElement) {
            targetElement.appendChild(element);
        } else {
            console.error(`Element with id '${position}' not found.`);
            return;
        }
    }
    setTimeout(() => remAlert(element), 2000);
}

function remAlert(element) {
    element.remove();
}

function setActive() {
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');

        for (i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let filename = file.split('.')[0];

            if (document.location.href.indexOf(filename) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }


let registerform = document.getElementById('registerform');

registerform.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();

    data.append('name', registerform.elements['name'].value);
    data.append('email', registerform.elements['email'].value);
    data.append('pnum', registerform.elements['pnum'].value);
    data.append('address', registerform.elements['address'].value);
    data.append('pincode', registerform.elements['pincode'].value);
    data.append('dob', registerform.elements['dob'].value);
    data.append('pass', registerform.elements['pass'].value);
    data.append('cpass', registerform.elements['cpass'].value);
    data.append('profile', registerform.elements['profile'].files[0]);
    data.append('register', '');

    var myModal = document.getElementById('RegisterModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/loginregister.php", true);

    xhr.onload = function () {
        console.log('Response:', this.responseText);
        if (this.responseText == 'pass-MisMatch') {
            alert('error', 'Password mismatch');

        }
        else if (this.responseText == 'email_already') {
            alert('error', 'Email is already');
        }
        else if (this.responseText == 'Phone_already') {
            alert('error', 'phone is already');
        }
        else if (this.responseText == 'inv_img') {
            alert('error', 'Only jpeg,webp & png upload');
        }
        else if (this.responseText == 'upd_failed') {
            alert('error', 'image failed');
        }
        else if (this.responseText == 'mail_failed') {
            alert('error', 'canot send mail');
        }
        else if (this.responseText == 'ins_failed') {
            alert('error', 'Registration failed');
        }
        else {
            alert('success', "Resgistration Successful. Confirmation link sent!");
            registerform.reset();
        }
    }

    xhr.send(data);
});


let loginform = document.getElementById('loginform');

loginform.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();

    data.append('emailmob', loginform.elements['emailmob'].value);
    data.append('pass', loginform.elements['pass'].value);

    data.append('login', '');

    var myModal = document.getElementById('loginModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/loginregister.php", true);

    xhr.onload = function () {
        console.log('Response:', this.responseText);
        if (this.responseText == 'inv_email_mob') {
            alert('error', 'Invalid Email or Mobile Number');

        }
        else if (this.responseText == 'not_verified') {
            alert('error', 'Email is Not verfied');
        }
        else if (this.responseText == 'inactive') {
            alert('error', 'Account Suspended! Please contact Admin.');
        }
        else if (this.responseText == 'invalid_pass') {
            alert('error', 'Incorrect Password!');
        }
        else {
            let fileurl=window.location.href.split('/').pop().split('?').shift();
            if(fileurl == 'eventdetail.php')
            {
                window.location=window.location.href;
            }
            else{
                window.location= window.location.pathname;
            } 
        }
    }

    xhr.send(data);
});


let forgotform = document.getElementById('forgotform');

forgotform.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();

    data.append('email', forgotform.elements['email'].value);
    data.append('forgotpass', '');

    var myModal = document.getElementById('forgotModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/loginregister.php", true);

    xhr.onprogress = function(){
        //
    }


    xhr.onload = function () {
        console.log('Response:', this.responseText);
        if (this.responseText == 'inv_email') {
            alert('error', 'Invalid Email');

        }
        else if (this.responseText == 'not_verified') {
            alert('error', 'Email is Not verfied! Contact Admin');
        }
        else if (this.responseText == 'inactive') {
            alert('error', 'Account Suspended! Please contact Admin.');
        }
        else if (this.responseText == 'mail_failed') {
            alert('error', 'Cannot send mail!');
        }
        else if (this.responseText == 'upd_failed') {
            alert('error', 'Password reset Failed. Server Down!!');
        }
        else {
            alert('success', 'Reset Link Sent to Email');
            forgotform.reset();
        }
    }

    xhr.send(data);
});

/*
function checkLoginToBook(status,eventid)
{
    if(status)
    {
        window.location.href='confirbooking.php?id='+eventid;
    }
    else
    {
        alert('error','Please Login to Book Event');
    }

}
*/
function checkLoginToBook(status, eventid) {
    if (status) {
        window.location.href = 'confirmbooking.php?id=' + eventid;
    } else {
        alert('Please Login to Book Event');
    }
}




setActive();

    </script>