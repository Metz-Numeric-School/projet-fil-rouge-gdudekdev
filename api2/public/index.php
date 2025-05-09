<?php
require dirname(__DIR__) . '/class/src/App.php';
App::_init();


if (isset($_GET['page'])) {
      $page = $_GET['page'];
      switch ($page) {

            case 'authenticate':
                  $controller = new \Src\Back\Authenticate\Controller\Authenticate;
                  $controller->authenticate($_POST, $_GET);
                  break;
            case 'home':
                  $controller = new \Src\Back\Home\Controller\Home;
                  $controller->handleHome();
                  break;
            case 'accounts':
                  $controller = new \Src\Back\Accounts\Controller\Accounts;
                  $controller->handle($_GET);
                  break;
            case 'entreprises':
                  $controller = new \Src\Back\Entreprises\Controller\Entreprises;
                  $controller->handle(array('GET' => $_GET, 'POST' => $_POST));
                  break;
            case 'preferences':
                  $controller = new \Src\Back\Preferences\Controller\Preferences;
                  $controller->handle($_GET);
                  break;
            case 'vehicules':
                  $controller = new \Src\Back\Vehicules\Controller\Vehicules;
                  $controller->handle($_GET);
                  break;
            case 'cars':
                  $controller = new \Src\Back\Cars\Controller\Cars;
                  $controller->handle($_GET);
                  break;
            case 'routes':
                  $controller = new \Src\Back\Routes\Controller\Routes;
                  $controller->handle($_GET);
                  break;
            case 'rides':
                  $controller = new \Src\Back\Rides\Controller\Rides;
                  $controller->handle($_GET);
                  break;
            case 'handlers':
                  \Src\Handlers\Handlers::instance()->handle($_GET, $_POST);
                  break;
            default:
                  http_response_code(404);
                  die("page non trouvée");
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
