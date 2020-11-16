<?php

require_once 'dbConn.inc.php';
require_once 'login-register.lib.inc.php';




if( !isset($_POST['submit']) ) {
    header('location: ../../login.php');
    die();
}




if( isset($_POST['login']) ) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $row = userExists($userName, $dbConn);

    if( $row === NULL ) {
        header('location: ../../login.php?err=Bad login info');
        die();
    }
    

    
}