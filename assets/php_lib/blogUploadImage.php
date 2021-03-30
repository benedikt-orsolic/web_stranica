<?php

include 'auto_loader.inc.php';

var_dump( $_FILES) ;
if( !isset( $_FILES['imgUpload']) && $_FILES['imgUpload']['error'] === 0) {
    http_response_code(400);
    echo('Bad request');
    die();
}


$blogImageHandler = new ImageHandler();
if(!$blogImageHandler->processImgFile($_FILES['imgUpload'])) {
    http_response_code(400);
    echo('Bad request');
    die();
}