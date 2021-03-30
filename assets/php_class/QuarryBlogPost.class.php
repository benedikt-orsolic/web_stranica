<?php

class QuarryBlogPost extends Dbh {

    public function getLastNPosts( $currentPostID, $limit) {

        if( $currentPostID <= -1 ) {
            $sql = "SELECT * FROM blog_posts ORDER BY upid DESC LIMIT ?;";
        } else {
            $sql = "SELECT * FROM blog_posts WHERE upid = ?;";
        }


        $stmt = $this->getConnection()->prepare( $sql );
        
        
        if( $currentPostID <= -1 ) {
            $stmt->execute( [$limit] );
        } else {
            $stmt->execute( [$currentPostID] );
        }


        return $stmt->fetchAll();
    }
}