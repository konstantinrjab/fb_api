function sendLogin() {
    var login = document.getElementById('input-login').value;
    var password = document.getElementById('input-password').value;
    var url = '/api/backend/token/';
    var parameters = 'login=' + login + '&password=' + password;
    request(url, parameters);
}

function getTwoRandomGirls() {
    var token = document.getElementById('token').value;
    var url = '/api/backend/get/random';
    var parameters = 'token=' + token;
    request(url, parameters);
}

function getSpecified() {
    var token = document.getElementById('token').value;
    var user_id = document.getElementById('specified-id').value;
    // var rating = document.getElementById('specified-rating').value;
    var status = document.getElementById('specified-status').value;
    var gender = document.getElementById('specified-gender').value;
    var order = document.getElementById('specified-order').value;
    var limit = document.getElementById('specified-limit').value;
    var offset = document.getElementById('specified-offset').value;
    var url = '/api/backend/get/specified';
    //'&user_id=' + user_id +
    var parameters = 'token=' + token + '&user_id=' + user_id +
        '&status=' + status + '&gender=' +
        gender + '&order=' + order + '&limit=' + limit + '&offset=' + offset;
    request(url, parameters);
}

function getAllRecords() {
    var token = document.getElementById('token').value;
    var url = '/api/backend/get';
    var parameters = 'token=' + token;
    request(url, parameters);
}

function updateRating() {
    var token = document.getElementById('token').value;
    var user_id = document.getElementById('update-rating-id').value;
    var rating = document.getElementById('update-rating-rating').value;
    var url = '/api/backend/update/rating';
    var parameters = 'token=' + token + '&user_id=' + user_id + '&rating=' + rating;
    request(url, parameters)
}

function addMember() {
    var token = document.getElementById('token').value;
    var user_id = document.getElementById('add-member-id').value;
    var name = document.getElementById('add-member-name').value;
    var url = '/api/backend/add/member';
    var parameters = 'token=' + token + '&user_id=' + user_id + '&name=' + name;
    request(url, parameters)
}

function request(url, parameters) {
    var xhttp = new XMLHttpRequest();
    var data;
    xhttp.open('POST', url, false);

    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send(parameters);
    data = xhttp.responseText;

    document.getElementById('response').value = data;
    var response_code = document.getElementById('response-code');
    if (xhttp.status !== 200) {
        response_code.style.color = 'red';
    } else {
        response_code.style.color = 'green';
    }
    document.getElementById('response-code').innerHTML = xhttp.status.toString();
}