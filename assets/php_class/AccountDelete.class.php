<?php

class AccountDelete extends Dbh {

    public function deleteUser (int $uuid) {
        
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
}