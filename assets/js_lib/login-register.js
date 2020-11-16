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
        console.log('hello');
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("invalidUserName").innerHTML = this.responseText;
        }
    };

    xhttp.open('POST', 'assets/php_lib/register.inc.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('submit=1&verifyUserName=1&userName=' + document.getElementById('registerName').value );
}



function validatePassword() {

    var minLowerCase = 3;
    var minUpperCase = 3;
    var minNum = 1;
    var minOther = 1;
    var minLength = 12;

    var lowerCase = 0;
    var upperCase = 0;
    var num = 0;
    var other = 0;
    
    var pass = document.getElementById('registerPassword').value;



    //Reset invalidPassword <p> element
    document.getElementById('invalidPassword').innerHTML = '';
    document.getElementById('invalidPassword').style.color = 'red';
    
    //Skip other checks if password is too short
    if( pass.length < minLength ) {
        document.getElementById('invalidPassword').innerHTML = 
        'Password too short';
        return;
    }

    //Count all character groups
    for( var i = 0; i < pass.length; i++ ) {
        if( pass.charCodeAt(i) >= 'a'.charCodeAt(0) && pass.charCodeAt(i) <= 'z'.charCodeAt(0)) lowerCase++;
        else if( pass.charCodeAt(i) >= 'A'.charCodeAt(0) && pass.charCodeAt(i) <= 'Z'.charCodeAt(0)) upperCase++;
        else if( pass.charCodeAt(i) >= '0'.charCodeAt(0) && pass.charCodeAt(i) <= '9'.charCodeAt(0)) num++;
        else other++;
    }
    
    // Print warnings
    //else if so we don't clutter invalid pass <p> element
    if( lowerCase < minLowerCase ) {
        document.getElementById('invalidPassword').innerHTML += 
        'You need ' + (minLowerCase - lowerCase) + ' lower case letters.'
    } else if ( upperCase < minUpperCase ) {
        document.getElementById('invalidPassword').innerHTML += 
        'You need ' + (minUpperCase - upperCase) + ' upper case letters.'
    } else if ( num < minNum ) {
        document.getElementById('invalidPassword').innerHTML += 
        'You need ' + (minNum - num) + ' numbers.'
    } else if ( other < minOther ) {
        document.getElementById('invalidPassword').innerHTML += 
        'You need ' + (minOther - other) + ' other characters.'
    } else {

        // If all checks out
        document.getElementById('invalidPassword').innerHTML = 
        'Password ok!';
        document.getElementById('invalidPassword').style.color = 
        'green';
    }
}

function validateEmail() {
    //Browser does it on its own
    //Change styleing only
}