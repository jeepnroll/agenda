<?php

/**
 * Class dbConfig
 * @name dbConfig .class.php => Définit
 * @project labo-formation-dl.
 * @author Webdev 2016-2017 -> BRUNET Jean-Philippe
 * @package
 **/
class dbConfig
{
    /**
     * @var string
     */
    public static $sgbd = "MySQL";

    /**
     * @var string
     */
    public static $host = "localhost";

    /**
     * @var int
     */
    public static $port = 3306;

    /**
     * @var string
     */
    private static $user = "Jeep";

    /**
     * @var string
     */
    private static $pswd = "Paiste@1379";

    /**
     * @var string
     */
    private static $dbName = "authentification";

    /**
     * @name getUser ->
     * @static
     * @return string
     */
    public static function getUser(){
        return self::$user;
    }

    /**
     * @name getPassword ->
     * @static
     * @return string
     */
    public static function getPassword(){
        return self::$pswd;
    }

    /**
     * @name getDBName ->
     * @static
     * @return string
     */
    public static function getDBName(){
        return self::$dbName;
    }

}