<?php

require_once 'dbConn.inc.php';
include_once 'constants.inc.php';

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

while($row = mysqli_fetch_assoc($result)){
    
    echo( '<article id="blogPost=' .$row['upid']. '" class="blogPost">');
    echo( '<h2 class="postTiele">'.$row['title'].'</h2>' );
    echo( '<p class="postText">'.getWithMarkDownToHTML( $row['text'] ) .'</p>' );
    echo( '</article>'); 
}

mysqli_stmt_close( $stmt );






/*
    **Bold text**
     *Italic   *
    * **Bold italic** *
    #heading#
    --- horizontal rule
    new lines separate paragraphs
    [color:#ffffff]{text} or [color:blue]
*/
function getWithMarkDownToHTML( $str ) {

    $len = strlen($str);
    $result = "";
    $lastPos = 0;
    
    //Highest heading
    do{
        $i = strpos($str, "#");
        $j = strpos($str, "#", $i + 1);

        if( $i !== false && $j !== false ) $str = substr($str, 0, $i) . "<h3>" . substr($str, $i+1, $j - $i - 1) . "</h3>" . substr($str, $j+1, $len);
        else break;
    } while(1);

    //Color
    do{
        $i = strpos($str, "[color:");
        $j = strpos($str, "]", $i + 1);

        $color = "";
        if( $i !== false && $j !== false ) $color = substr($str, $i+7, $j - $i - 7);
        else break;
        
        $textOpen = strpos($str, "{");
        $textClose = strpos($str, "}");

        if( $textOpen !== false && $textClose !== false && $i !== false && $j !== false ) {
            $str = 
            substr($str, 0, $i) . 
            "<span style='color: " . 
            $color . "'>" . 
            substr($str, $textOpen+1, $textClose - $textOpen - 1) . 
            "</span>" . 
            substr($str, $textClose+1, $len);
        }
        else break;
    } while(1);


    //Bold text
    do{
        $i = strpos($str, "**");
        $j = strpos($str, "**", $i + 1);

        if( $i !== false && $j !== false ) $str = substr($str, 0, $i) . "<strong>" . substr($str, $i+2, $j - $i - 2) . "</strong>" . substr($str, $j+2, $len);
        else break;
    } while(1);

    //Italic
    do{
        $i = strpos($str, "*");
        $j = strpos($str, "*", $i + 1);

        if( $i !== false && $j !== false ) $str = substr($str, 0, $i) . "<em>" . substr($str, $i+1, $j - $i - 1) . "</em>" . substr($str, $j+1, $len);
        else break;
    } while(1);

    //Horizontal rule
    do{
        $i = strpos($str, "---");

        if( $i !== false ) $str = substr($str, 0, $i) . "<hr>" . substr($str, $i+3, $len);
        else break;
    } while(1);


    //Paragraphs
    do{
        $i = strpos($str, "\n");
        $j = strpos($str, "\n", $i + 1);

        if( $i !== false && $j !== false ) $str = substr($str, 0, $i) . "<p>" . substr($str, $i+1, $j - $i - 1) . "</p>" . substr($str, $j+1, $len);
        else break;
    } while(1);

    return $str;
}