<?php

include 'auto_loader.inc.php';

if( !isset($_POST['submit']) ) {
    header('location: ../../blog.php');
    die();
}

$title = $_POST['title'];
$body = $_POST['body'];
$postImage = $_POST['postImage'];

//Input sanitise

$upload = new UploadBlogPost();
$upload->uploadPost( $title, $body, $postImage );


header('location: ../../blog.php');