<?php
//Neccassry To be Found
ob_start();
session_start();
//DataBase Config Sections
define("HOST", 'localhost');
define("DB_USER", 'root');
define("DB_PASS", "");
define("CHAR_SET", 'SET NAMES utf8');
// Short Codes
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

// SHORT APP
define("APP_PATH", realpath(dirname(__FILE__)));
define("Controllers", APP_PATH . DS . 'app' . DS . "Controllers" . DS);
define("Functions", APP_PATH . DS . 'app' . DS . "Functions" . DS);
define("Libs", APP_PATH . DS . 'app' . DS . "Libs" . DS);
define("Models", APP_PATH  . DS . 'app' . DS . "Models" . DS);
define("Views", APP_PATH . DS . 'app' . DS . "Views" . DS);
// This Is For Include Path To Require OOP
$path = get_include_path() . PS . Controllers . PS . Models;
set_include_path($path);
//Included Classes
require_once Libs . 'FrontController.php';
spl_autoload_register(function ($class) {
    require_once ucfirst($class) . ".php";
});
$front = new FrontController();
$front->dispatch();
//End Of File
ob_end_flush();
?>