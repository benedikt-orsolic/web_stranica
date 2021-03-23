<?php

include '../php_lib/auto_loader.inc.php';

class QuarryBlogPost extends Dbh {

    public function getLastNPosts( $nextPostID, $n ) {
        
        if( $lastPostID == -1 ) {
            $sql = "SELECT * FROM blog_posts ORDER BY upid DESC LIMIT ?;";
        } else {
            $sql = "SELECT * FROM blog_posts WHERE upid = ?;";
        }

        $stmt = $this->getConnection()->prepare( $sql );
        
        
        if( $lastPostID == -1 ) {
            $stmt->execute( [$n] );
        } else {
            $stmt->execute( [$nextPostID] );
        }

        return $stmt->fetchAll();
    }
}