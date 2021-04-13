<?php

include 'auto_loader.inc.php';



if( !isset($_SESSION['uuid'])) {
    http_response_code(401);
    die();
}

if( (!isset( $_FILES['imgUpload']) && $_FILES['imgUpload']['error'] === 0)  || 
     !isset($_POST['upid'])) {
    http_response_code(400);
    die();
}



$quarryBlogPost = new QuarryBlogPost();
$postRaw = $quarryBlogPost->getLastNPosts($_POST['upid'], 1);
var_dump($postRaw);
$postOwner = $postRaw['ownerId'];
$postId = $postRaw['upid'];

if( $postOwner != $_SESSION['uuid'] ) {
    http_response_code(401);
    die();
}



$blogImageHandler = new ImageHandler();
if(!$blogImageHandler->processImgFile($postId, $postOwner, $_FILES['imgUpload'])) {
    http_response_code(400);
    echo('Bad request');
    die();
}