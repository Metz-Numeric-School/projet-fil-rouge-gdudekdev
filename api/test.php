<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Config\FactoryTable;


FactoryTable::getInstance();

?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
</head>
<body>
      <a href="/app/model/index.php"><\Retour</a>
</body>
</html>

<!-- TODO desgin pattern observer + regarder pour les Middlewares from scratch ofc -->
 <!-- TODO voir si on peut stocker sous forme de tableau les éléments issus des champs des tables de la bdd -->
  <!-- TODO système de log lors de la connexion , ajout, modification et suppresion dans la bdd -->