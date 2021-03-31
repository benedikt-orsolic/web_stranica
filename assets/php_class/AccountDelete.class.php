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
        
        $imgFolderPath = '../../images/';
        $imgList = scandir($imgFolderPath);
        $uuidStr = (String)($uuid);

        for( $i = 2; $i < count($imgList); $i++ ) {
            echo $uuidStr . ' - ' . explode('-', $imgList[$i])[1] . '<br>';
            if(strcmp($uuidStr, explode('-', $imgList[$i])[1]) === 0) {
                unlink($imgFolderPath . $imgList[$i]);
            }
        }
        
    }
}