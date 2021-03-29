<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if( !isset($_SESSION['uuid'])) {
        header('location: index.php');
        die();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <?php include 'assets/html_lib/global_head_elements.html' ?>
    <link rel="stylesheet" href="assets/css_lib/login.css">
</head>

<body>
    <?php include 'assets/html_lib/nav.php' ?>
    <main>
        
        <form action="assets/php_lib/account_delete.inc.php" method="post">
            <button name="accountDelete" value="accountDelete">Delete account</button>
        </form>
    </main>
</body>

<script src="assets/js_lib/login-register.js"></script>

</html>