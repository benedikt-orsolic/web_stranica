<?php

class FormatBlogPostOutput extends MarkDownToHtml {

    public function formatPost ( $posts ) {

        if( isset($_SESSION['uuid'])) $uuid = $_SESSION['uuid'];
        else $uuid = null;

        $resultStr = '';

        foreach( $posts as $row) {

            $str;
            if( $row['text'] === null ) $str = '';
            else {
                $this->setStr( $row['text'] );
                $str = $this->getStr();
            }
            
            $resultStr .=
                   '<article id="blogPost=' . $row['upid'] . '" class="blogPost">' .
                   '<h2 class="postTitle">'. $row['title'] . '</h2>' .
                   '<section class="postText">' . $str . '</section>' .
                   '<address>' . $row['ownerId'] . '</address>';
            $resultStr .=
                   $uuid !== null && $row['ownerId'] === $uuid ? '<button name="editPost">Edit post</button>' : '';
            $resultStr .=
                   '<br>';
            $resultStr .=
                   '</article>'; 
        }

        return $resultStr;
    }
}