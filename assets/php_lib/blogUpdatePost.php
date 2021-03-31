<?php

include 'auto_loader.inc.php';
session_start();

if( !isset($_POST['upid']) ) {
    http_response_code(400);
    die();
}

if( !isset($_SESSION['uuid']) ){
    http_response_code(401);
    die();
}

$owner = $_SESSION['uuid'];


$update = new BlogUpdatePost();
$update->update($_POST['upid'], $_POST['title'], $_POST['body']);

if( isset($_POST['returnFormatted'])) {
    $postFormatting = new FormatBlogPostOutput();
    $postFormatting->formatPost(
        array(0 => array(
            'upid' => $_POST['upid'],
            'title' => $_POST['title'],
            'ownerId' => $owner,
            'text' => $_POST['body']
        ))
    );
}