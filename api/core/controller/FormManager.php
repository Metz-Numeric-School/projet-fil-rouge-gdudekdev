<?php
namespace Core\Controller;

use App\Controller\Manager;
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
                  Manager::getInstance()->delete($_GET['table'],$_GET['id']);
            }
            
      }
      public function initPOST(){
            if(isset($_POST['form'])){
                  if(isset($_POST['id'])){
                        $obj = Database::getInstance()->getOneFrom($_POST['form'],'id',$_POST['id']);
                        return $obj;
                  }else{
                        $obj = Manager::getInstance()->createObj($_GET['table']);
                        $obj = $obj->getData();
                        return $obj;
                  } 
            }else{
                  header("Location: /app/model/index.php");
                  exit();
            }
      }



}