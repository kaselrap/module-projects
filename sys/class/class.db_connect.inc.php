<?php

/**
 * Class DB_Connect
 */
class DB_Connect
{
    /**
     * Stores a database object
     * 
     * @var object A database object
     */
    protected $dbo;

    /**
     * Check for a DB objects or creates one f isn't found
     * @param object $dbo A database object
     */
    public function __construct( $dbo = NULL )
    {
        if( is_object($dbo) ) {
            $this->dbo = $dbo;
        } else {
            //Constants are defined in '../sys/core/init.inc.php'
            $dsn = 'mysql:host='. DB_HOST .';dbname=' . DB_NAME;
            try {
                $dbo = R::setup( $dsn ,
                    DB_USER, DB_PASS );
            } catch ( Exception $e ) {
                // If the DB connection fails, output the error
                die( $e->getMessage() );
            }
        }
    }
}