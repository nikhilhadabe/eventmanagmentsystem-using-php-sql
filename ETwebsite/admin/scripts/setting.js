
let generaldata, contactsdata;

let generalsform = document.getElementById('generalsform');
let sitetitleinp = document.getElementById('sitetitleinp');
let siteaboutinp = document.getElementById('siteaboutinp');

let contactsform = document.getElementById('contactsform');

let teamsform = document.getElementById('teamsform');
let membername = document.getElementById('membernameinp');
let memberpictures = document.getElementById('memberpicturesinp');


function getgeneral() {
    let sitetitle = document.getElementById('sitetitle');
    let siteabout = document.getElementById('siteabout');


    let shutdowntoggle = document.getElementById('shutdown-toggle');


    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/settingscrud.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    /* xhr.onreadystatechange =function() {
           if(this.readyState==4 && this.status==200){}}*/
    /*ajax code*/
    xhr.onload = function () {
        generaldata = JSON.parse(this.responseText);

        sitetitle.innerText = generaldata.sitetitle;
        siteabout.innerText = generaldata.siteabout;

        sitetitleinp.value = generaldata.sitetitle;
        siteaboutinp.value = generaldata.siteabout;

        if (generaldata.shutdown == 0) {
            shutdowntoggle.checked = false;
            shutdowntoggle.value = 0;
        }
        else {
            shutdowntoggle.checked = true;
            shutdowntoggle.value = 1;
        }
    }
    xhr.send('getgeneral');
}


generalsform.addEventListener('submit', function (e) {
    e.preventDefault();
    updgeneral(sitetitleinp.value, siteaboutinp.value);


})


function updgeneral(sitetitleval, siteaboutval) {
    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/settingscrud.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {

        var myModal = document.getElementById('general-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'Changes saved!');
            getgeneral();
        } else {
            alert('error', 'No Changes Made!');
        }


    }
    xhr.send('&sitetitle=' + sitetitleval + '&siteabout=' + siteaboutval + '&updgeneral');

}


function updshutdown(val) {
    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/settingscrud.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText == 1 && generaldata.shutdown == 0) {
            alert('success', 'Site has been Shutdown!');

        } else {
            alert('success', 'Shutdown Mode is OFF!');
        }
        getgeneral();
    }
    xhr.send('updshutdown=' + val);

}


function getcontacts() {
    let contactsid = ['address', 'gmap', 'pn1', 'pn2', 'email', 'fb', 'insta', 'tw'];
    let iframe = document.getElementById('iframe');




    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/settingscrud.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        contactsdata = JSON.parse(this.responseText);
        contactsdata = Object.values(contactsdata);

        //  console.log(contactsdata);
        for (i = 0; i < contactsid.length; i++) {
            document.getElementById(contactsid[i]).innerText = contactsdata[i + 1];
        }
        iframe.src = contactsdata[9];
        contactsinp(contactsdata);

    }
    xhr.send('getcontacts');
}



function contactsinp(data) {
    let contactsinpid = ['addressinp', 'gmapinp', 'pn1inp', 'pn2inp', 'emailinp', 'fbinp', 'instainp', 'twitinp', 'iframeinp'];

    for (i = 0; i < contactsinpid.length; i++) {
        document.getElementById(contactsinpid[i]).value = data[i + 1];
    }
}


contactsform.addEventListener('submit', function (e) {
    e.preventDefault();
    updcontacts();
})


function updcontacts() {
    let index = ['address', 'gmap', 'pn1', 'pn2', 'email', 'fb', 'insta', 'tw', 'iframe'];
    let contactsinpid = ['addressinp', 'gmapinp', 'pn1inp', 'pn2inp', 'emailinp', 'fbinp', 'instainp', 'twinp', 'iframeinp'];

    let datastr = "";

    for (i = 0; i < index.length; i++) {
        datastr += index[i] + "=" + document.getElementById(contactsinpid[i]).value + '&';
    }
    datastr += "updcontacts";

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/settingscrud.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        var myModal = document.getElementById('contact-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        if (this.responseText == 1) {
            alert('success', 'Changes saved!');
            getcontacts();

        } else {
            alert('error', 'NO changes made!');
        }

    }

    xhr.send(datastr);

}



teamsform.addEventListener('submit', function (e) {
    e.preventDefault();
    addmember();
});

function addmember() {

    let data = new FormData();
    data.append('name', membernameinp.value);
    data.append('picture', memberpicturesinp.files[0]);
    data.append('addmember', '');


    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/settingscrud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById('team-s');
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
            alert('success', 'new member added!');
            membernameinp.values = '';
            memberpicturesinp.values = '';
            getmembers();
        }
    }
    xhr.send(data);

}


function getmembers() {

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/settingscrud.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('teamdata').innerHTML = this.responseText;

    }

    xhr.send('getmembers');

}


function remmembers(val) {

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/settingscrud.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'member removed!')
            getmembers();
        }
        else {
            alert('error', 'Server Down');
        }

    }
    xhr.send('remmembers=' + val);


}



window.onload = function () {
    getgeneral();
    getcontacts();
    getmembers();
}

