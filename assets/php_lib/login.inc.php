<?php

require_once 'dbConn.inc.php';
require_once 'login-register.lib.inc.php';




if( !isset($_POST['submit']) ) {
    header('location: ../../login.php');
    die();
}




if( isset($_POST['login']) ) {

    $userName = $_POST['username'];
    $password = $_POST['password'];

    $user = userExists($userName, $dbConn);
    if( $user === NULL || !password_verify($password, $user['password']) ) {
        header( 'location: ../../login.php?err=Bad login info');
        die();
    }

    session_start();
    $_SESSION['uuid'] = $user['uuid'];
    $_SESSION['userName'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    header('location: ../../index.php?uuid='.$_SESSION['uuid']);
    
    die();
}