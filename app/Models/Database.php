<?php
// This Is Singelton Class For Connect DB
class Database {
    private function __constructor () {}
    private function __clone () {}
    protected static $once;
    protected static $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => CHAR_SET,
    );
    public static function connect () {
        try {
            if (NULL === self::$once) {
                self::$once = new PDO('mysql:host=' . HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, self::$option);
                self::$once->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$once;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>