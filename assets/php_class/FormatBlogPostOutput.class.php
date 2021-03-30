<?php

class FormatBlogPostOutput extends MarkDownToHtml {

    public function formatPost ( $posts ) {

        foreach( $posts as $row) {

            $str;
            if( $row['text'] === null ) $str = '';
            else {
                $this->setStr( $row['text'] );
                $str = $this->getStr();
            }
        
            print_r('<article id="blogPost=' . $row['upid'] . '" class="blogPost">' .
                   '<h2 class="postTitle">'. $row['title'] . '</h2>' .
                   '<section class="postText">' . $str . '</section>' .
                   '<address>' . $row['ownerId'] . '</address>' .
                   '</article>'); 
        }
    }
}