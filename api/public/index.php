<?php
require 'vendor/autoload.php';

use App\Router\Router;

$router = new Router();

$router->addRoute('GET', '/', function () {
      echo 'Bienvenue sur la page d\'accueil';
});

$router->addRoute('GET', '/about', function () {
      echo 'Page À propos';
});

$router->addRoute('GET', '/user/{id}', function ($id) {
      echo "Profil de l'utilisateur avec l'ID : $id";
});

$router->addRoute('GET', '/article/{slug}', function ($slug) {
      echo "Lecture de l'article avec le slug : $slug";
});
$router->addRoute('POST', '/register', function ($data) {
      if (isset($data['username']) && isset($data['password'])) {
            echo "Utilisateur inscrit : " . htmlspecialchars($data['username']);
      } else {
            echo "Erreur : données manquantes";
      }
});

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));