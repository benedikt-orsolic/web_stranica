<?php

if( !isset($_POST['submit']) ) {
    header('location: ../../blog.php');
}

$title = $_POST['title'];
$body = $_POST['body'];
$postImage = $_POST['postImage'];

echo( $title );
echo( $body );
echo( $postImage );