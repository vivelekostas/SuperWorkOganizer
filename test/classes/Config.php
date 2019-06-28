<?php

/**
 * Конфиг подключения к BD
 *
 * @author User
 */
class Config {

    private static $host = 'localhost';
    private static $username = 'mysql';
    private static $passwd = 'mysql';
    private static $dbname = 'kostas';
    private static $charset = 'utf8';

    public static function getHost() {
        return self::$host;
    }

    public static function getUsername() {
        return self::$username;
    }

    public static function getPasswd() {
        return self::$passwd;
    }

    public static function getDBname() {
        return self::$dbname;
    }

    public static function getCharset() {
        return self::$charset;
    }

}
