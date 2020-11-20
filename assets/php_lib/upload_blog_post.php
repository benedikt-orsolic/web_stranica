<?php

require_once 'dbConn.inc.php';
require_once 'blog_post.lib.php';

if( !isset($_POST['submit']) ) {
    header('location: ../../blog.php');
    die();
}

$title = $_POST['title'];
$body = $_POST['body'];
$postImage = $_POST['postImage'];

//Input sanitise

uploadPost( $title, $body, $postImage, $dbConn );

echo( $title );
echo( $body );
echo( $postImage );