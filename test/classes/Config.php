<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author User
 */
//Пример суперлютого ООП! Больше ООП!!

class Config {
    static $host = 'localhost';
    static $username = 'mysql';
    static $passwd = 'mysql';
    static $dbname = 'kostas';
    
    static function myHost() {
        return self::$host;
    }
    static function myUsername() {
        return self::$username;
    }
    static function myPasswd() {
        return self::$passwd;
    }
    static function myDBname() {
        return self::$dbname;
    }
}


