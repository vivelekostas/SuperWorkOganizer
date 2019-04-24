<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Конфиг подключения к BD
 *
 * @author User
 */
class Config {

    static $host = 'localhost';
    static $username = 'mysql';
    static $passwd = 'mysql';
    static $dbname = 'kostas';
    static $charset = 'utf8';

    static function getHost() {
        return self::$host;
    }

    static function getUsername() {
        return self::$username;
    }

    static function getPasswd() {
        return self::$passwd;
    }

    static function getDBname() {
        return self::$dbname;
    }
    
    static function getCharset() {
        return self::$charset;
    }

}
