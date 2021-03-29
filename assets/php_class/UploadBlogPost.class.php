<?php

class UploadBlogPost extends Dbh {

    public function uploadPost( $title, $body ) {

        $sql = 'INSERT INTO blog_posts (title, text) VALUES ( ?, ? );';
        $stmt = $this->getConnection()->prepare( $sql );

        $title = htmlentities($title);
        $body = htmlentities($body);

        
        $stmt->execute( [$title, $body] );
        
    }
}



