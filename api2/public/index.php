<?php

use Src\Test;

require dirname(__DIR__) . '/class/src/App.php';
App::_init();


Test::test_img(2);
\Src\Router\Router::run();
