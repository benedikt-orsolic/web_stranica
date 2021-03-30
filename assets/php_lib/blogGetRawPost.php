<?php

include 'auto_loader.inc.php';
session_start();

if( !isset($_POST['upid']) ) {
    http_response_code(400);
    die();
}

if( !isset($_SESSION['uuid']) ) {
    http_response_code(401);
    die();
}

$getRawBlog = new QuarryBlogPost();
$post = $getRawBlog->getLastNPosts($_POST['upid'], 1)[0];

if( !isset($post['upid'])) {
    http_response_code(404);
    echo('Post not found');
}

if( $post['ownerId'] !== $_SESSION['uuid'] ) {
    http_response_code(401);
    echo('You don\'t own this post');
}

header('Content-Type: application/json');
echo json_encode($post);