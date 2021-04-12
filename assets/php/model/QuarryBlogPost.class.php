<?php

class QuarryBlogPost extends Dbh {

    public function getLastNPosts( $currentPostID, $limit) {

        if( $currentPostID <= -1 ) {
            $sql = "SELECT * FROM blog_posts ORDER BY upid DESC LIMIT ?;";
        } else {
            $sql = "SELECT * FROM blog_posts WHERE upid = ?;";
        }
    

        $stmt = PDOSingleton::getInstance()->prepare( $sql );
        
        
        if( $currentPostID <= -1 ) {
            $stmt->execute( [$limit] );
        } else {
            $stmt->execute( [$currentPostID] );
        }


        return $stmt->fetchAll();
    }
}