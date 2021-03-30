<?php

class UploadBlogPost extends Dbh {

    public function uploadPost( $title, $body ) {

        $sql = 'INSERT INTO blog_posts (title, text) VALUES ( ?, ? );';
        $stmt = $this->getConnection()->prepare( $sql );
        $stmt->execute( [$title, $body] );
        
    }
}



