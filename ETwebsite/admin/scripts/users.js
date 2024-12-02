

function getusers() {
    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        document.getElementById('usersdata').innerHTML = this.responseText;

    }

    xhr.send('getusers');
}



function togglestatus(id, val) {

    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'status toggled');
            getusers();
        }
        else {
            alert('error', 'server down')
        }

    }

    xhr.send('togglestatus=' + id + '&value=' + val);

}



function removeuser(userid) {
    if (confirm("Are you Sure, You want to delete this User?")) {
        let data = new FormData();
        data.append('userid', userid);
        data.append('removeuser', '');


        let xhr = new XMLHttpRequest(); //it is object
        xhr.open("POST", "ajax/users.php", true);

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success', 'User Removed!!');
                getusers();
            }
            else {
                alert('error', 'User removal Failed!');
            }
        }
        xhr.send(data);
    }

}

function searchuser(username)
{
    let xhr = new XMLHttpRequest(); //it is object
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        document.getElementById('usersdata').innerHTML = this.responseText;

    }

    xhr.send('searchuser&name='+username);
}


window.onload = function () {
    getusers();
}


