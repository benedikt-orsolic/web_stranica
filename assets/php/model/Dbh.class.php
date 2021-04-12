<?php

class Dbh {

    // Adapter for older classes
    protected function getConnection () {

        return PDOSingleton::getInstance();
    }
}