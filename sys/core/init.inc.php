<?php

/*
 * Include the necessary configuration info
 */
include_once "../config/db-credentials.inc.php";

/*
 * Require the ORM library as ReadbeanPHP
 */
require "rb-mysql.php";
/*
 * Define constants for configuration indo
 */
foreach ($C as $name => $value) {
    define($name, $value);
}

/*
 * Create an ORM object
 */

$dsn = 'mysql:host='. DB_HOST .';dbname=' . DB_NAME;
$dbo = R::setup( $dsn ,
    DB_USER, DB_PASS );
/*
 * Define the autoload function for classes
 */
spl_autoload_register(function ($class_name) {
    $filename = '../sys/class/class.' . mb_strtolower($class_name) . '.inc.php';

    if ( is_readable($filename) ) {
        include_once $filename;
    }
});