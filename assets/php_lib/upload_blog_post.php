<?php

include 'auto_loader.inc.php';

if( !isset($_POST['submit']) ) {
    header('location: ../../blog.php');
    die();
}

$title = $_POST['title'];
$body = $_POST['body'];
//$postImage = $_POST['postImage'];

//Input sanitize

session_start();
$upload = new UploadBlogPost();
$upload->uploadPost( $title, $body, $_SESSION['uuid'] );


// Need to get it from db for a upid
$postQuarry = new QuarryBlogPost();
$posts = $postQuarry->getLastNPosts( - 1, 1);



file_put_contents ( '../../logs/debug.log' , 'hello', FILE_APPEND | LOCK_EX);
$getPostFromDb = new QuarryBlogPost();
$markdownToHtml = new MarkdownToHtml();



$blogPostFormating = new FormatBlogPostOutput();
echo ( $blogPostFormating->formatPost( $posts ) );
//header('location: ../../blog.php');