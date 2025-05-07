<?php
require dirname(__DIR__). '/class/src/App.php';
App::_init();


if (isset($_GET['page'])) {
      $page = $_GET['page'];
      switch ($page) {
            
            case 'authenticate':
                  $controller = new \Src\Back\Authenticate\Controller\Authenticate;
                  $controller->authenticate($_POST,$_GET);
                  break;
            case 'home':
                  $controller = new \Src\Back\Home\Controller\Home;
                  $controller->handleHome();    
                  break;
            case 'accounts':
                  $controller = new \Src\Back\Accounts\Controller\Accounts;
                  $controller->handle(array('GET'=>$_GET,'POST'=>$_POST));
                  break;
            case 'handlers':
                  \Src\Handlers\Handlers::instance()->handle($_GET,$_POST);
                  break;
            case 'preferences':
                  $controller = new PreferencesController;
                  $controller->handle($_GET);
                  break;
            default:
                  http_response_code(404);
                  die("page non trouvée");
      }
}
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      http_response_code(200);
      exit();
}
if (isset($_GET['api'])) {
      $path = $_GET['api'];
      $data = [
            'headers' => getallheaders(),
            'body' => json_decode(file_get_contents('php://input'), true),
      ];

      switch ($path) {
            case 'login':
                  $controller = new ApiLoginController;
                  $controller->handleLogin($data);
                  break;
            case 'fetch':
                  $controller = new ApiFetchController;
                  $controller->handleFetch($data);
                  break;
            default :
                  http_response_code(400);
                  die("Requete mal formulée");
      }
}
