<?php


require dirname(__DIR__) . '/class/src/App.php';
App::_init();


if (isset($_GET['page'])) {
     
      $page = ucfirst($_GET['page']);
      $class = '\Src\Controller\\' . $page;
      if (class_exists('\Src\Controller\\' . $page)) {
            $controller = new $class;
            $controller->handle($_GET,$_POST);
      } else {
            $controller = new \Src\Controller\Home;
            $controller->handle($_GET,$_POST);
      }
}

// if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//       http_response_code(200);
//       exit();
// }
// if (isset($_GET['api'])) {
//       $path = $_GET['api'];
//       $data = [
//             'headers' => getallheaders(),
//             'body' => json_decode(file_get_contents('php://input'), true),
//       ];

//       switch ($path) {
//             case 'login':
//                   $controller = new ApiLoginController;
//                   $controller->handleLogin($data);
//                   break;
//             case 'fetch':
//                   $controller = new ApiFetchController;
//                   $controller->handleFetch($data);
//                   break;
//             default:
//                   http_response_code(400);
//                   die("Requete mal formulée");
//       }
// }
