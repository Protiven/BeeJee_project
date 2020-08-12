<?php 
// FONT CONTROLLER
// General set up
session_start();
ini_set('display_errors', 0);
//error_reporting(E_ALL);

// Load Router and another
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/autoload.php');
autoload::loadObject("Router");
autoload::loadObject("db");
autoload::loadObject("Auth");

db::getConnection();

// Call Router
$router = new Router();
$router->run();
?>