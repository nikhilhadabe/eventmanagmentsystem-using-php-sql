


function getbookings(search = '',page=1) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/bookingrecords.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        let data=JSON.parse(this.responseText);
        document.getElementById('tabledata').innerHTML = data.tabledata;
        document.getElementById('tablepagination').innerHTML = data.pagination;
    }

    xhr.send('getbookings&search=' +search+'&page='+page);
}


function changepage(page){
    getbookings(document.getElementById('searchinput').value.page)

}


window.onload = function () {
    getbookings();
}


