<?php

class BlogCreatePost {

    public function createPostInDB(int $owner) {

        $sql = 'INSERT INTO blog_posts (ownerId) VALUES ( ? );';

        $stmt = PDOSingleton::getInstance()->prepare( $sql );

        if( $stmt === false ) {
            http_response_code(500);
            return NULL;
        }

        $stmt->execute( [$owner] );

        return $this->getUPID($owner);
    }



    private function getUPID(int $owner) {
        
        $sql = 'SELECT upid FROM blog_posts WHERE ownerId = ? ORDER BY upid DESC LIMIT 1 ';

        $stmt = PDOSingleton::getInstance()->prepare( $sql );

        if( $stmt === false ) {
            http_response_code(500);
            return NULL;
        }

        $stmt->execute( [$owner] );

        return $stmt->fetchAll()[0]['upid'];
    }
}