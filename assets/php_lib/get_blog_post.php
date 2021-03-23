<?php

include_once 'auto_loader.inc.php';


if( !isset($_POST['submit']) ) {
    die();
}


$upid = $_POST['upid'];

$postQuarry = new QuarryBlogPost();
$posts = $postQuarry->getLastNPosts( $upid - 1, 5);

$markDownToHtml = new MarkDownToHtml();


foreach( $posts as $row) {

    $markDownToHtml->setStr( $row['text'] );

    echo( '<article id="blogPost=' . $row['upid'] . '" class="blogPost">');
    echo( '<h2 class="postTitle">'. $row['title'] . '</h2>' );
    echo( '<section class="postText">' . $markDownToHtml->getStr() . '</section>' );
    echo( '</article>'); 
}