<?php

class UploadBlogPost {

    public function uploadPost( $title, $body ) {

        $sql = 'INSERT INTO blog_posts (title, text) VALUES ( ?, ? );';
        $stmt = PDOSingleton::getInstance()->prepare( $sql );
        $stmt->execute( [$title, $body] );
        
    }
}



