<?php

use Api\Class\Router;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';


$allowedOrigin = 'http://localhost:5173';
$requestOrigin = $_SERVER['HTTP_REFERER'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      http_response_code(200);
      exit();
}

if (isset($_GET['path'])) {
      $headers = getallheaders();
      $body = json_decode(file_get_contents('php://input'), true);
      $data =[
            'headers'=>$headers,
            'body'=>$body,
      ];
      Router::getInstance()->addCurrentRoute($_GET['path'], $data);
}