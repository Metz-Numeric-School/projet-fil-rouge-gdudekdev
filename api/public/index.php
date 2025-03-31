<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Core\Router;
$router = new Router();

$routes = require_once __DIR__ . '/../app/routes.php';
$routes($router);
print $router->dispatch();