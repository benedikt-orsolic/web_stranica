<?php

class QuarryBlogPost extends Dbh {

    public function getLastNPosts( $nextPostID, $limit) {

        if( $nextPostID <= -1 ) {
            $sql = "SELECT * FROM blog_posts ORDER BY upid DESC LIMIT ?;";
        } else {
            $sql = "SELECT * FROM blog_posts WHERE upid = ?;";
        }


        $stmt = $this->getConnection()->prepare( $sql );
        
        
        if( $nextPostID <= -1 ) {
            $stmt->execute( [$limit] );
        } else {
            $stmt->execute( [$nextPostID] );
        }


        return $stmt->fetchAll();
    }
}