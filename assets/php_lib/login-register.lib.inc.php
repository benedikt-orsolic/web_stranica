<?php

include_once 'constants.inc.php';



/* NULL for no user, anything else if found something */
function userExists( $userName, $dbConn ) {
    

    $sql = 'SELECT * FROM users WHERE username = ?;';
    $stmt = mysqli_stmt_init( $dbConn );

    if( !mysqli_stmt_prepare($stmt, $sql) ) {
        file_put_contents ( 'DB_ERR_LOG' , 'login-register.lib.inc.php - mysqli_stmt_prepare() fail'."\r\n " , FILE_APPEND | LOCK_EX);
    }

    mysqli_stmt_bind_param($stmt, 's', $userName);
    mysqli_stmt_execute( $stmt );

    $result = mysqli_stmt_get_result( $stmt );
    $row = mysqli_fetch_assoc( $result );
    
    mysqli_stmt_close( $stmt );
    
    return $row;
}


function insertUser($userName, $password, $email, $dbConn) {

    $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init( $dbConn );

    if( !mysqli_stmt_prepare( $stmt, $sql )) {
        echo('prep fail');
        die();
    }

    $password = password_hash( $password, PASSWORD_DEFAULT );

    mysqli_stmt_bind_param( $stmt, 'sss', $email, $userName, $password);
    mysqli_stmt_execute( $stmt );
    mysqli_stmt_close( $stmt );
}

/* Return NULL if no errors or warnings */
function passwordValid( $password ) {

    //Search for all invalid passwords
    $pattern = '/^(.{0,7}|[^0-9]*|[^A-Z]*|[^a-z]*|[a-zA-Z0-9]*)$/';
    $minLen = 12;
    
    if( strlen($password) < $minLen == 1 ) return 'Password too short';//return 'Password too short';
    if( preg_match( $pattern, $password) ) return 'Password needs 1 lowercase letter, 1 uppercase, 1 number and 1 other character';
    return NULL;
}