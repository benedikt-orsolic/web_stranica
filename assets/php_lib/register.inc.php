<?php

require_once 'dbConn.inc.php';

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



    $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init( $dbConn );

    if( !mysqli_stmt_prepare( $stmt, $sql )) {
        echo('prep fail');
        die();
    }

    $password = password_hash( $password, PASSWORD_DEFAULT );

    mysqli_stmt_bind_param( $stmt, 'sss', $email, $userName, $password);
    mysqli_stmt_execute( $stmt );

    

}
