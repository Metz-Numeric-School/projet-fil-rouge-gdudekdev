<?php 
namespace App\Controller;

// TODO faire un manager de manager
// TODO __sleep __wakeup
// TODO need template.php + MVC
/**
 * Pour que le Manager fonctionne, il faut que chaque sous Manager soit instatiable via singleton, il faut aussi qu'il ait tous la méthode new
 */
class Manager{
      private static $instance = null;

      private function __construct()
      {
            
      }

      public static function getInstance(){
            if(is_null(self::$instance)){
                  self::$instance = new Manager;
            }
            return self::$instance;
      }
      /**
       * Instancie un objet en  correspondance à la table passée en paramètre (possiblité de l'hydrater via $data)
       */
      public function initClass(string $table,$data = null){
            $obj = ucfirst($table);
            return new $obj($data);
      }

}