<?php
//file_put_contents ( file , msg, FILE_APPEND | LOCK_EX);
//mysqli_error($dbConn)
/**
 * debug.log.txt    // debug info
 * db_error.log.txt       // DB errors info
 * error.log.txt    // General errors in code worth loging
 * 
 * 
 * echo date('Y-m-d H:i:s');
 */
define('DB_ERR_LOG', 'logs/db.log.txt');
define('DEBUG_LOG', 'logs/debug.log.txt');