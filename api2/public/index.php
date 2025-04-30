<?php

use Api\Controller\ApiFetchController;
use Api\Controller\ApiLoginController;
use Back\Accounts\AccountsController;
use Back\Authentificate\AuthentificateController;
use Back\Controller\ProcessController;
use Back\Home\HomeController;
use Back\Preferences\PreferencesController;

require '../vendor/autoload.php';
include_once __DIR__ . "/../config/config.php";




if (isset($_GET['page'])) {
      $page = $_GET['page'];
      switch ($page) {
            
            case 'authentificate':
                  $controller = new AuthentificateController;
                  $controller->handleAuthentificate($_POST,$_GET);
                  break;
            case 'home':
                  $controller = new HomeController;
                  $controller->handleHome();
                  break;
            case 'accounts':
                  $controller = new AccountsController;
                  $controller->handle($_GET);
                  break;
            case 'preferences':
                  $controller = new PreferencesController;
                  $controller->handle($_GET);
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
