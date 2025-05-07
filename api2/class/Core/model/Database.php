<?php

namespace Core\Model;

use PDO;

class Database
{
      private static $PDOInstance;

      public function __construct()
      {
                  self::$PDOInstance = new PDO(DEFAULT_DSN, DEFAULT_HOST, DEFAULT_PASS);
      }
  
      public function getAllFrom(string $table, $asc = '_id')
      {
            $stmt = self::$PDOInstance->prepare("SELECT * FROM $table ORDER BY $table$asc ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function getOneFrom(string $table, $champ, $value)
      {
            $stmt = self::$PDOInstance->prepare("SELECT * FROM $table WHERE " . $champ . "= :value");
            $stmt->execute([":value" => $value]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
      }
      public function delete(string $table,  int $id)
      {
            $stmt = self::$PDOInstance->prepare("DELETE FROM $table WHERE " . $table . "_id = :id");
            $stmt->execute([':id' => $id]);
      }
      /**
       * @param $object : array relatif à sa structure dans la table $table de la BDD
       */
      public function update(string $table, array $data)
      {
            $values = "";
            $id = $data[$table . '_id'];
            foreach ($data as $key => $value) {
                  $values .= $key . "=" . "'" . $value . "',";
            }
            $values = substr($values, 0, -1);
            $stmt = self::$PDOInstance->prepare("UPDATE $table SET $values WHERE " . $table . "_id=:id");
            $stmt->execute([':id' => $id]);
      }
      public function add(string $table, array $value)
      {
            $sql = '(';
            foreach ($value as $k => $v) {
                  $sql .= $k . ',';
            }
            $sql = substr($sql, 0, -1);
            $sql .= ') VALUES (';
            foreach ($value as $k => $v) {
                  $sql .= ":" . $k  . ',';
            }
            $sql = substr($sql, 0, -1);
            $sql .= ')';
            $execute  = [];
            foreach ($value as $k => $v) {
                  $execute[':' . $k] = $v;
            }
            $stmt = self::$PDOInstance->prepare("INSERT INTO $table $sql");
            $stmt->execute($execute);
      }
      /**
       * @var table : table name
       * @var bool  : associative array formated as follow
       *              ['stmt'=>string "boolean statement (e.g : id =:id)",
       *                'params'=>array ['marker'=>value (e.g: [':id'=>id]])
       */
      public function getAllFromWhere($table,$bool){
            $stmt = self::$PDOInstance->prepare("SELECT * FROM $table WHERE " . $bool['stmt'] );
            $stmt->execute($bool['params']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function deleteFromWhere($table,$bool){
            $stmt = self::$PDOInstance->prepare("DELETE FROM $table WHERE " . $bool['stmt'] );
            $stmt->execute($bool['params']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function updateFromWhere($table,$bool){
            $stmt = self::$PDOInstance->prepare("UPDATE $table SET $bool WHERE " . $bool['stmt'] );
            $stmt->execute($bool['params']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
}
