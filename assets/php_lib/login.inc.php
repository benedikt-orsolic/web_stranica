<?php

require_once 'dbConn.inc.php';




if( !isset($_POST['submit']) ) {
    header('location: ../../login.php');
    die();
}




if( isset($_POST['login']) ) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    
    
    $sql = 'SELECT * FROM users WHERE username = ?;';
    $stmt = mysqli_stmt_init($dbConn);

    if( !mysqli_stmt_prepare($stmt, $sql) ) {
        //Prep fail
        //TODO
        echo(' stmt prep fail ');
    }

    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute( $stmt );

    $result = mysqli_stmt_get_result( $stmt );
    $row = mysqli_fetch_assoc( $result );

    if( $row === NULL ) {
        header('location: ../../login.php?err=Bad login info');
        die();
    }
    

    if( password_verify($password, $row['password']) ) {
        echo( ' user valid <br>');
    }

    mysqli_stmt_close( $stmt );


}