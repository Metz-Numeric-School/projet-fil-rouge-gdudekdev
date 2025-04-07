<?php 
// TODO faire un manager de manager
// TODO __sleep __wakeup
// TODO need template.php + MVC
class Manager{
      private static $instance = null;
      private static $type = null;

      private function __construct()
      {
            
      }

      public static function getInstance(string $table){
            if(is_null(self::$instance)){
                  self::$instance = new Manager;
                  self::$type = $table;
            }
            return self::$instance;
      }

}