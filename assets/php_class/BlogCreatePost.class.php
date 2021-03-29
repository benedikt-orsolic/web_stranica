<?php

class BlogCreatePost extends Dbh{

    public function createPostInDB(int $owner) {

        $sql = 'INSERT INTO blog_posts (ownerId) VALUES ( ? );';

        $stmt = $this->getConnection()->prepare( $sql );

        if( $stmt === false ) {
            http_response_code(500);
            return NULL;
        }

        $stmt->execute(  );

        return $this->getUPID($owner);
    }



    private function getUPID(int $owner) {
        
        $sql = 'SELECT upid FROM blog_posts WHERE ownerId = ? ORDER BY upid DESC LIMIT 1 ';

        $stmt = $this->getConnection()->prepare( $sql );

        if( $stmt === false ) {
            http_response_code(500);
            return NULL;
        }

        $stmt->execute( [$owner] );

        return $stmt->fetchAll()[0]['upid'];
    }
}