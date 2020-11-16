<?php

require_once 'dbConn.inc.php';
require_once 'login-register.lib.inc.php';


if( !isset($_POST['submit']) ) {
    header('location: ../../login.php');
    die();
}

//TODO
//Input validation


if( isset($_POST['register'])) {
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if( userExists( $userName, $dbConn ) !== NULL ) {
        header( 'location: ../../login.php?err=User alredy exists');
    }

    insertUser( $userName, $password, $email, $dbConn);
    exit();
}


if( isset($_POST['verifyUserName']) ){
    $userName = $_POST['userName'];

    if( userExists( $userName, $dbConn ) !== NULL ) {
        echo( 'Username  in use');
    }
    exit();
}














