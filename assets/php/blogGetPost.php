<?php

require_once 'autoLoader.php';

if( !isset($_POST['submit']) ) {
    die();
}


$upid = $_POST['upid'];
$limit = $_POST['limit'];

$postQuarry = new QuarryBlogPost();
$posts = $postQuarry->getLastNPosts( $upid - 1, $limit);


$blogPostFormatting = new FormatBlogPostOutput();
echo $blogPostFormatting->formatPost( $posts );