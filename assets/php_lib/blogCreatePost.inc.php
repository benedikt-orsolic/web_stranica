<?php

include 'auto_loader.inc.php';

if( !isset($_POST['createPostInDB']) ) die();
if( !isset($_SESSION['uuid'])) die();


$blogCreate = new BlogCreatePost();
$newPostId = $blogCreate->createPostInDB($_SESSION['uuid']);

if( $newPostId !== NULL ) echo( $newPostId );

die();