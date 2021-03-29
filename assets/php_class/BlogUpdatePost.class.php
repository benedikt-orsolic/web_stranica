<?php

class BlogUpdatePost extends Dbh{

    public function update(int $upid, string $title, string $text) {

        $sql = 'UPDATE blog_posts SET title=?, text=? WHERE upid = ?;';

        $stmt = $this->getConnection()->prepare( $sql );

        if( $stmt === false ) {
            http_response_code(500);
            return NULL;
        }

        $stmt->execute( [$title, $text, $upid] );
    }
}