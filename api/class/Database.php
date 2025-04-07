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
                  self::$instance = new self;
            }
            return self::$instance;
      }
      public function getAllFrom(string $table){
            $stmt = $this->PDOInstance->prepare("SELECT * FROM $table");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      // TODO rajouter un argument dans la fonction getOneFrom pour prendre le champ ciblé + la valeur associé et pas juste la valeur avec le champ en dur
      public function getOneFrom(string $table, $champ ="", $value=null){
            $stmt = $this->PDOInstance->prepare("SELECT * FROM $table WHERE $champ = :value OR (1=1)");
            $stmt->execute([":value"=>$value]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
      }
      public function delete(string $table,  int $id){
            $stmt = $this->PDOInstance->prepare("DELETE FROM $table WHERE id = :id");
            $stmt ->execute([':id'=>$id]);
      }
      /**
       * @param $object : array relatif à sa structure dans la table $table de la BDD
       */
      public function update(string $table , array $object){
            $values = "";
            $id = $object['id'];
            foreach($object as $key=>$value){
                  $values .= $key . "=" . "'". $value . "',";
            }
            // On retire juste la dernière virgule qui est de trop
            $values =substr($values,0,-1);
            $stmt = $this->PDOInstance->prepare("UPDATE $table SET $values WHERE id = $id");
            $stmt->execute();
      }

}
