<!DOCTYPE html>
<html>



<head>
    <meta name="viewport" content="width=device-widht, initial-scale=1"/>
    <link rel="stylesheet" href="login.css">
    <title> log in</title>
</head>



<body>
    <h1 id="login-button" onmouseover="switchForm(0)"  style="background-color: #888888">Log in</h1>
    <h1 id="register-button" onmouseover="switchForm(1)">Register</h1>

    <form id="login-form" name="login" method="POST">
        <h2>Username:</h2>
        <input type="text" name="user-name">
        <br>

        <h2>Password:</h2>
        <input type="password" name="password">
        <br>

        <input class="submitButton" name="submit" type="button" value="Log in">
    </form>

    <form id="register-form" name="register" method="POST" style="display: none">
        <h2>Username:</h2>
        <input name="user-name" type="text">
        <br>

        <h2>Password:</h2>
        <input name="password" type="password">
        <br>

        <h2>E-mail:</h2>
        <input name="email" type="email">
        <br>

        <input class="submitButton" name="submit" type="button" value="Register">

    </form>
</body>



<script>
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
</script>

</html>

