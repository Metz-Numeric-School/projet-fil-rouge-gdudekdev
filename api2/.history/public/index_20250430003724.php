<?php

use Api\Controller\ApiFetchController;
use Api\Controller\ApiLoginController;
use Back\Controller\AccountsController;
use Back\Controller\CrudController;
use Back\Controller\CrudDetailController;
use Back\Controller\HomeController;
use Back\Controller\LoginController;
use Back\Controller\LogoutController;
use Back\Controller\ProcessController;

require '../vendor/autoload.php';
include_once __DIR__ . "/../config/config.php";
include_once __DIR__ .'/../config/plannings_json.php';

if (isset($_GET['page'])) {
      $page = $_GET['page'];
      switch ($page) {
            case 'login':
                  $controller = new LoginController;
                  $controller->handleLogin($_POST);
                  break;
            case 'logout':
                  $controller = new LogoutController;
                  $controller->handleLogout();
                  break;
            case 'home':
                  $controller = new HomeController;
                  $controller->handleHome();
                  break;
            case 'accounts':
                  $controller = new AccountsController;
                  $controller->handle();
                  break;
            case 'crud-detail':
                  $controller = new CrudDetailController;
                  $controller->handleCrudDetail($_GET);
                  break;
            case 'process':
                  $controller = new ProcessController;
                  $controller->handleProcess($_GET, $_POST);
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
