<?php

class Database {
    private function __constructor () {}
    private function __clone () {}
    protected static $once;
    protected static $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    public static function connect () {
        try {
            if (NULL === self::$once) {
                self::$once = new PDO('mysql:host=localhost;dbname=tawzeev', 'root', '', self::$option);
                self::$once->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$once;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>