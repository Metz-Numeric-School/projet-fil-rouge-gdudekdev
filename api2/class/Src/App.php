<?php 

use Core\Model\Database;

class App{
      public static $db;
      public static function _init(){
            require __DIR__ . "/../../config/config.php";
            self::register();
            self::$db = new Database();
      }
      private static function register(){
            spl_autoload_register([__CLASS__,"autoload"]);
      }
      private static function autoload($class){
            if(!str_contains($class, "Firebase")){
                  require ROOT . "/class/" . $class . '.php';
            }
            else{
                  
                  require ROOT . "/vendor/Firebase/JWT.php" ;
                  require ROOT . "/vendor/Firebase/Key.php" ;
            }
            echo 'firebase';
      }
}