<?php

class FormatBlogPostOutput extends MarkDownToHtml {

    public function formatPost ( $posts ) {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if( isset($_SESSION['uuid'])) $uuid = $_SESSION['uuid'];
        else $uuid = null;
        ;

        foreach( $posts as $row) {

            $str;
            if( $row['text'] === null ) $str = '';
            else {
                $this->setStr( $row['text'] );
                $str = $this->getStr();
            }
        
            echo   '<article id="blogPost=' . $row['upid'] . '" class="blogPost">' .
                   '<h2 class="postTitle">'. $row['title'] . '</h2>' .
                   '<section class="postText">' . $str . '</section>' .
                   '<address>' . $row['ownerId'] . '</address>';
            echo   $uuid !== null && $row['ownerId'] === $uuid ? '<button name="editPost">Edit post</button>' : '';
            echo   '<br>';
            
            $imgList = scandir('../../images');
            $upidStr = (String)($row['upid']);

            for( $i = 2; $i < count($imgList); $i++ ) {
                
                if(strcmp($upidStr, explode('-', $imgList[$i])[0]) === 0) {
                    echo '<img class="postImage" src="images/'. $imgList[$i] . '">';
                }
            }
            echo   '</article>'; 
        }
    }
}