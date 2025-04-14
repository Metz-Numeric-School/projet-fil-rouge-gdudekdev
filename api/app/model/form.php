<?php
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Controller\Manager;
use Config\Config;
use Core\Class\Auth;
use Core\Class\Database;

Auth::getInstance()->protect();
// Initialisation de l'objet nous permettant d'afficher un formulaire en lien avec la table passée en GET
$obj=[];
// Lorsque l'on arrive sur la page pour la première fois, on est soit dans le cas d'une suppresion
if (isset($_GET['mode']) && $_GET['mode'] == "remove" && isset($_GET['table']) && isset($_GET['id'])) {
      Manager::getInstance()->delete($_GET['table'], $_GET['id']);
      header("Location: crud?table={$_GET['table']}.php");
      exit();
}
// Soit dans le cas d'un ajout/modification, il faut dans cette situation pouvoir afficher les données correspondantes dans le formulaire
if (isset($_GET['mode']) && $_GET['mode'] == "save" && isset($_GET['table'])) {
      if (isset($_GET['id'])) {
            $table = $_GET['table'];
            $obj = Database::getInstance()->getOneFrom($table , $table .'_id', $_GET['id']);
      } else {
            $obj = Manager::getInstance()->blankObjFrom($_GET['table']);
      }
}

// Enfin, il y a la logique de gestion du retour du formulaire, on vient sauvegarder la modification apportée, on les récupére dans le post;
if (isset($_POST[$_GET['table'] . '_id'])) {
      date_default_timezone_set('Europe/Paris');
      $data = [];
      foreach($_POST as $k=>$v){
            // permet, dans le cas où on veut passer une valeur null à notre champ, de bien renvoyer cette donnée et non une chaine vide
            if(str_contains($k,'_at')){
                  $data[$k] = date('Y-m-d h:m:s');
            }else{
                  $data[$k] = $v;
            }
      }
      Manager::getInstance()->save($_GET['table'], $data);
      header("Location: crud.php?table={$_GET['table']}");
      exit();
}

$currentPage  = Config::TABLE_CONFIG[$_GET['table']] ?? "";
$title = "formulaire CRUD";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/view/form_view.php";
