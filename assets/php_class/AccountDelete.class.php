<?php

class AccountDelete extends Dbh {

    public function deleteUser (int $uuid) {
        
        $this->deleteAllImages($uuid);
        $this->deletePosts($uuid);
        $this->deleteInUsers($uuid);
    }

    private function deleteInUsers( int $uuid) {
        $sql = 'DELETE FROM users WHERE uuid = ?;';
        $stmt = $this->getConnection()->prepare( $sql );
        $stmt->execute( [ $uuid ] );
    }

    private function deletePosts(int $uuid) {
        $sql = 'DELETE FROM blog_posts WHERE ownerId = ?;';
        $stmt = $this->getConnection()->prepare( $sql );
        $stmt->execute( [ $uuid ] );
    }

    private function deleteAllImages(int $uuid) {
        $sql = 'SELECT upid FROM blog_posts WHERE ownerId = ?;';
        $stmt = $this->getConnection()->prepare( $sql );
        $stmt->execute( [ $uuid ] );

        $rows = $stmt->fetchAll();
        foreach($rows as $row) {
            $imgList = scandir('../../images');
            $upidStr = (String)($row['upid']);

            for( $i = 2; $i < count($imgList); $i++ ) {
                
                if(strcmp($upidStr, explode('-', $imgList[$i])[0]) === 0) {
                    unlink($imgList[$i]);
                }
            }
        }
    }
}