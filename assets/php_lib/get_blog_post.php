<?php

require_once 'dbConn.inc.php';
include_once 'constants.inc.php';
include_once 'auto_loader.inc.php';


if( !isset($_POST['submit']) ) {
    die();
}


$upid = $_POST['upid'];

if( $upid == -1 ) {
    $sql = "SELECT * FROM blog_posts ORDER BY upid DESC LIMIT 5;";
} else {
    $sql = "SELECT * FROM blog_posts WHERE upid = ?;";
}

$stmt = mysqli_stmt_init( $dbConn );
$result = NULL;

if( !mysqli_stmt_prepare( $stmt, $sql )) {
    file_put_contents ( '../../db_error.log.txt' , 'assets/php_lib/get_blog_posts.php no function'.mysqli_error($dbConn)."\r\n ", FILE_APPEND | LOCK_EX);
    die();
}

if( $upid != -1 ) {
    do{
        $upid--;
        if( $upid < 0) {
            file_put_contents ('../../logs/error.log.txt' , date('Y-m-d H:i:s').' - '.'$upid < 0'."\r\n" , FILE_APPEND | LOCK_EX);
            die();
        }
        mysqli_stmt_bind_param( $stmt, 'i', $upid);
        
        mysqli_stmt_execute( $stmt );
        $result = mysqli_stmt_get_result( $stmt );

    } while ( mysqli_num_rows($result) == 0 );
} else {
    mysqli_stmt_execute( $stmt );
    $result = mysqli_stmt_get_result( $stmt );
}

$markDownToHtml = new MarkDownToHtml();

while($row = mysqli_fetch_assoc($result)){
    
    $markDownToHtml->setStr( $row['text'] );

    echo( '<article id="blogPost=' .$row['upid']. '" class="blogPost">' . "\n");
    echo( '<h2 class="postTiele">'.$row['title'].'</h2>' . "\n" );
    echo( '<section class="postText">' . "\n\n" . $markDownToHtml->getStr() . '</section></article>' . "\n\n" );
}

unset( $markDownToHtml );

mysqli_stmt_close( $stmt );