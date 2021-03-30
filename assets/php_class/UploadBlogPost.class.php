<?php

class UploadBlogPost extends Dbh {

    public function uploadPost( string $title, string $body, int $ownerId ) {

        $sql = 'INSERT INTO blog_posts (title, text, ownerId ) VALUES ( ?, ?, ? );';
        $stmt = $this->getConnection()->prepare( $sql );

        $title = htmlentities($title);
        $body = htmlentities($body);

        
        $stmt->execute( [$title, $body, $ownerId] );
        
    }
}



