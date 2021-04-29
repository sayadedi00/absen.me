<?php
/* Defines */
define('DB_SERVER', $site['db_host']);
define('DB_USERNAME', $site['db_username']);
define('DB_PASSWORD', $site['db_password']);
define('DB_DATABASE', $site['db_database']);

/*Function to make a connection*/
function db () {
    static $connect;
    if ($connect === NULL){ 
        $connect = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }
    return $connect;
}