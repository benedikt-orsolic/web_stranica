<?php


include 'auto_loader.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if( !isset($_SESSION['uuid'])) die();
if( !isset($_POST['accountDelete'])) die();

$accDelete = new AccountDelete();
$accDelete->deleteUser($_SESSION['uuid']);

include 'logout.php';


//header('location: index.php');
die();