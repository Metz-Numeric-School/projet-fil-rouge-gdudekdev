<?php 

class Database{

      const DEFAULT_DSN="mysql:dbname=carpool;host=localhost";
      const DEFAULT_HOST = "root";
      const DEFAULT_PASS =""; 

      private static $instance = null;
      private  $PDOInstance = null;

      private function __construct()
      {
            $this->PDOInstance = new PDO(self::DEFAULT_DSN, self::DEFAULT_HOST, self::DEFAULT_PASS);
      }
      public static function getInstance(){
            if(is_null(self::$instance))
            {
                  self::$instance = new Database();
            }
            return self::$instance;
      }
      public function getAllFrom(string $table){
            $stmt = $this->PDOInstance->prepare("SELECT * FROM $table");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function getOneFrom(string $table, $target_id=null){
            $stmt = $this->PDOInstance->prepare("SELECT * FROM $table WHERE email = :id OR (1=1)");
            $stmt->execute([":id"=>$target_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
      }

}
