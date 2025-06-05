<?php
// require dirname(__DIR__) . '/test.php';
// exit();
require dirname(__DIR__) . '/class/src/App.php';
App::_init();


\Src\Router\Router::run();
