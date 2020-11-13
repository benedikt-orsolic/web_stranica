<?php

$serverName = 'localhost';
$dbUser = 'root';
$dbUserPwd = '';
$dbName = 'personal_web_page';

$dbConn = mysqli_connect( $serverName, $dbUser, $dbUserPwd, $dbName );

if( !$dbConn ) {
    echo('db error');
}