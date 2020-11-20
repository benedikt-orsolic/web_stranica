<?php

function uploadPost( $title, $body, $postImage, $dbConn ) {

    $sql = 'INSERT INTO blog_posts (title, text) VALUES ( ?, ? );';
    $stmt = mysqli_stmt_init( $dbConn );

    if( !mysqli_stmt_prepare($stmt, $sql) ) {
        file_put_contents ( '../../'.'DB_ERR_LOG' , 'login-register.lib.inc.php - mysqli_stmt_prepare() fail'."\r\n ". 
                                                     mysqli_error($dbConn)."\r\n" , FILE_APPEND | LOCK_EX);
    }

    mysqli_stmt_bind_param($stmt, 'ss', $title, $body);
    mysqli_stmt_execute( $stmt );
    
    mysqli_stmt_close( $stmt );
}