<?php 
session_start();

define('ROOT', dirname(__DIR__));
define('REDIRECT_PROTECT_PATH', 'index.php?page=authenticate');
define("DEFAULT_DSN","mysql:dbname=carpool;host=localhost");
define("DEFAULT_HOST","root");
define("DEFAULT_PASS","");