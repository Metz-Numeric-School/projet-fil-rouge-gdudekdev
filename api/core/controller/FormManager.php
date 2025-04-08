<?php
namespace Core\Controller;

use App\class\User;
use App\Controller\UserManager;
use Core\Class\Database;

/**
 * 
 * L'objectif de ce Manager est de controler les arrivées des formulaires sur la page où il est appelé, il est initialisé à sa déclaration et doit permettre de venir faire appel aux bonnes méthodes suivant le contenu de $_POST ou $_GET
 * 
 * Il y a deux cas : si je reçois une demande d'accès à un formulaire relatif à une table de la BDD(GET) et si je reçois les données du même formulaire (POST)
 */
class FormManager{

      private static $instance = null;


      private function __construct(){

      
      }

      public static function getInstance(){
            if(is_null(self::$instance)){
                  self::$instance = new self;
            }
            return self::$instance;
      }

      public function initGET(){
            if (isset($_GET['delete']) && isset($_GET['id']) && isset($_GET['table']) && $_GET['delete'] == true) {
                  // TODO faire un appel à <Obj>Manager de manière dynamique
                  if ($_GET['table'] == 'users') {
                        if ($_GET['table'] == 'users') {
                              UserManager::getInstance()->delete($_GET['id']);
                        }
                  }
            }
            
      }
      public function initPOST(){
            if(isset($_POST['form'])){
                  if(isset($_POST['id'])){
                        $obj = Database::getInstance()->getOneFrom($_POST['form'],'id',$_POST['id']);
                        return $obj;
                  }else{
                        // TODO le pb est ici plus précissement, il faut pouvoir init un nouvel Objet relatif a la BDD (cela implique de faire toutes les classes nécessaires au bon fonctionnement du tout)
                        $obj = new User();// instanciation par rapport à $table
                        $obj = $obj->getData();
                        return $obj;
                  } 
            }else{
                  header("Location: /pages/index.php");
                  exit();
            }
      }



}