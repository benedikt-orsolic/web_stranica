<?php

class FormatBlogPostOutput extends MarkDownToHtml {

    public function formatPost ( $posts ) {

        foreach( $posts as $row) {

            $this->setStr( $row['text'] );
        
            return '<article id="blogPost=' . $row['upid'] . '" class="blogPost">' .
                   '<h2 class="postTitle">'. $row['title'] . '</h2>' .
                   '<section class="postText">' . $this->getStr() . '</section>' .
                   '</article>'; 
        }
    }
}