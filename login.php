<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if( isset($_SESSION['uuid'])) {
        header('location: index.php');
        die();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <?php include 'html_lib/global_head_elements.html' ?>
    <link rel="stylesheet" href="assets/css_lib/login.css">
</head>

<body>
    <?php include 'html_lib/nav.php' ?>
    <main>
        <h1 id="login-button" style="background-color: #888888">Log in</h1>
        <h1 id="register-button">Register</h1>

        <form id="login-form" action="assets/php_lib/login.inc.php" method="post">
            <h2>Username:</h2>
            <input type="text" name="username">
            <br>

            <h2>Password:</h2>
            <input type="password" name="password">
            <br>

            <input type="hidden" name="login" value="0"/>
            <input class="submitButton" name="submit" type="submit" value="Log in">
        </form>

        <form id="register-form"  action="assets/php_lib/register.inc.php" method="post" style="display: none;">
            <h2>Username:</h2>
            <input id="registerName" name="userName" type="text">
            <p id="invalidUserName" class="invalidInput"></p>
            <br>

            <h2>Password:</h2>
            <input id="registerPassword" name="password" type="password">
            <p id="invalidPassword" class="invalidInput"></p>
            <br>

            <h2>Password repeat:</h2>
            <input id="registerPasswordRepeat" name="passwordRepeat" type="password">
            <p id="invalidPasswordRepeat" class="invalidInput"></p>
            <br>

            <h2>E-mail:</h2>
            <input id="registerEmail" name="email" type="email">
            <br>

            <input type="hidden" name="register" value="0"/>
            <input class="submitButton" name="submit" type="submit" value="Register">
        </form>
        <?php if( isset($_GET['err'])) echo('<p class="invalidInput">' . $_GET['err'] . '</p>'); ?>
        
    </main>
</body>

<script src="assets/js_lib/login-register.js"></script>

</html>

