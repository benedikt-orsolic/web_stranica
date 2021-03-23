<?php

class Dbh {

    private $host = 'localhost';
    private $user = 'root';
    private $pwd  = '';
    private $db   = 'personal_web_page';

    protected function getConnection () {

        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db . ';';
        $pdo = new PDO($dsn, $this->user, $this->pwd);

        // Db returns result as associative array
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}