<?php

include 'auto_loader.inc.php';


if( !isset($_POST['submit']) ) {
    header('location: ../../login.php');
    die();
}

//TODO
//email verification


$userQuarry = new QuarryUser();


if( isset($_POST['register'])) {
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if( $userQuarry->userExists( $userName ) !== NULL ) {
        //header( 'location: ../../login.php?err=User alredy exists');
    }

    $passwordCheckResult = $userQuarry->passwordValid( $password );
    if( !$passwordCheckResult ) {
        header( 'location: ../../login.php?err='.$passwordCheckResult );
    }

    $userQuarry->insertUser( $userName, $password, $email);
    exit();
}

if( isset($_POST['verifyUserName']) ){
    $userName = $_POST['userName'];

    if( $userQuarry->userExists( $userName ) !== NULL ) {
        echo( 'Username  in use');
    }
    exit();
}

if( isset($_POST['verifyPassword']) ) {

    $password = $_POST['password'];
    $passwordCheckResult = $userQuarry->passwordValid($password);
    if ($passwordCheckResult != NULL) echo( $passwordCheckResult );
    else echo( 'Ok' );
}

if( isset($_POST['validatePasswordRepeat']) ) {

    $password = $_POST['password'];
    $passwordRpt = $_POST['passwordRepeat'];

    if( strcmp( $password, $passwordRpt ) == 1) {
        echo('Password OK');
        die();
    } else {
        echo('Passwords don\'t match');
        die();
    }
}













