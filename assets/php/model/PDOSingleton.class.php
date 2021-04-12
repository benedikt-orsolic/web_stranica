<?php

class PDOSingleton {

    private static $host = 'localhost';
    private static $user = 'root';
    private static $pwd  = '';
    private static $db   = 'personal_web_page';



    private static $instance = null;



    private function __construct() {
        // Do nothing
    }

    public function __clone() {
        throw new Exception('Can\'t clone singleton');
    }

    public function getInstance () {
        if(self::$instance === null) {
            self::$instance = self::createPDO();
        }
        return self::$instance;
    }

    private static function createPDO () {

        $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$db . ';';
        $pdo = new PDO($dsn, self::$user, self::$pwd);
        
        // Db returns result as associative array
        $pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

        return $pdo;
    }
}