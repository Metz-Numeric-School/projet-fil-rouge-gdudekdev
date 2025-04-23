<?php
require '../vendor/autoload.php';

use Controller\CrudController;
use Controller\HomeController;
use Controller\LoginController;
use Controller\LogoutController;
use Controller\ProcessController;

$page = isset($_GET['page']) ? $_GET['page'] : '';

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
      case 'crud':
            $controller = new CrudController;
            $controller->handleCrud($_GET);
            break;
      case 'process':
            $controller = new ProcessController;
            $controller->handleProcess($_GET,$_POST);
            break;
      default:
            http_response_code(404);
            die("page non trouvée");
}
