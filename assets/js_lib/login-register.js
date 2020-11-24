function switchForm(which) {

    var login = document.getElementById('login-form').style;
    var loginButton = document.getElementById('login-button').style;

    var register = document.getElementById('register-form').style;
    var registerButton = document.getElementById('register-button').style;

    switch ( which ) {
        case 0:
            login.display = 'block';
            loginButton.backgroundColor = '#888888';

            register.display = 'none';
            registerButton.backgroundColor = 'white';
            break;
        case 1:
            login.display = 'none';
            loginButton.backgroundColor = 'white';

            register.display = 'block';
            registerButton.backgroundColor = '#888888';
            break;
    }
}



function validateUsername() {
    
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("invalidUserName").innerHTML = this.responseText;
        }
    };

    xhttp.open('POST', 'assets/php_lib/register.inc.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('submit=1&verifyUserName=1&userName=' + document.getElementById('registerName').value );
}

function validatePassword() {

    var xhttp = new XMLHttpRequest();
    
    
    xhttp.onreadystatechange = function() {
        
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('invalidPassword').innerHTML = this.responseText;
        }
    };

    xhttp.open('POST', 'assets/php_lib/register.inc.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('submit=1&verifyPassword=1&password=' + document.getElementById('registerPassword').value );
}

function validatePasswordRepeat() {
    var pwd = document.getElementById('registerPassword').value;
    var pwdRPT = document.getElementById('registerPasswordRepeat').value;

    var xhttp = new XMLHttpRequest();
    
    
    xhttp.onreadystatechange = function() {
        
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('invalidPasswordRepeat').innerHTML = this.responseText;
        }
    };

    xhttp.open('POST', 'assets/php_lib/register.inc.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('submit=1&validatePasswordRepeat=1&password=' + pwd + '&passwordRepeat=' + pwdRPT );
}

function validateEmail() {
    //Browser does it on its own
    //Change styleing only
}