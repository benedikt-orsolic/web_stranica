<?php

class BlogUpdatePost {

    public function update(int $upid, string $title, string $text) {

        $sql = 'UPDATE blog_posts SET title=?, text=? WHERE upid = ?;';

        $stmt = PDOSingleton::getInstance()->prepare( $sql );

        if( $stmt === false ) {
            http_response_code(500);
            return NULL;
        }

        $stmt->execute( [$title, $text, $upid] );
        return $stmt->fetchAll();
    }
}