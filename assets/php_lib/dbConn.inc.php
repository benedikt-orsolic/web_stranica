<?php

$serverName = 'localhost';
$dbUser = 'root';
$dbUserPwd = '';
$dbName = 'personal_web_page';

$dbConn = mysqli_connect( $serverName, $dbUser, $dbUserPwd, $dbName );

if( !$dbConn ) {
    file_put_contents ( 'DB_ERR_LOG' , 'dbConn.lib.inc.php - mysqli_connect() fail'."\r\n " , FILE_APPEND | LOCK_EX);
}