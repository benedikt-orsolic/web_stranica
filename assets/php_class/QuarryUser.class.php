<?php

class QuarryUser extends Dbh {
    
    /* NULL for no user, anything else if found something */
    public function userExists( $userName ) {
        

        $sql = 'SELECT * FROM users WHERE username = ?;';
        $stmt = $this->getConnection()->prepare( $sql );
        $stmt->execute( [ $userName ] );

        $result = $stmt->fetch(); 

        if( empty( $result ) == 1 ) return NULL;
        return $result;

    }


    public function insertUser($userName, $password, $email) {

        $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?);";
        $stmt = $this->getConnection()->prepare( $sql );

        $password = password_hash( $password, PASSWORD_DEFAULT );

        $userName = htmlentities($userName);
        $password = htmlentities($password);
        $email = htmlentities($email);

        $stmt->execute( [ $email, $userName, $password ] );

        print_r( $stmt->fetchAll());
    }

    /* Return NULL if no errors or warnings */
    public function passwordValid( $password ) {

        //Search for all invalid passwords
        $pattern = '/^(.{0,7}|[^0-9]*|[^A-Z]*|[^a-z]*|[a-zA-Z0-9]*)$/';
        $minLen = 12;
        
        if( strlen($password) < $minLen == 1 ) return 'Password too short';//return 'Password too short';
        if( preg_match( $pattern, $password) ) return 'Password needs 1 lowercase letter, 1 uppercase, 1 number and 1 other character';
        return NULL;
    }
}