<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Core\Controller\Router;

$allowedOrigin = 'http://localhost:5173';
$requestOrigin = $_SERVER['HTTP_REFERER'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      http_response_code(200);
      exit();
}

$router = new Router();
if (isset($_GET['path'])) {
      $headers = getallheaders();
      $body = json_decode(file_get_contents('php://input'), true);
      $data =[
            'headers'=>$headers,
            'body'=>$body,
      ];
      $router->addCurrentRoute($_GET['path'], $data);
}

      
