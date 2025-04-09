<?php

namespace Core\Class;

use PDO;

class Database
{
      private const DEFAULT_DBNAME = "carpool";
      private const DEFAULT_DSN = "mysql:dbname=". self::DEFAULT_DBNAME .";host=localhost";
      private const DEFAULT_HOST = "root";
      private const DEFAULT_PASS = "";

      private static $instance = null;
      private  $PDOInstance = null;

      private function __construct()
      {
            $this->PDOInstance = new PDO(self::DEFAULT_DSN, self::DEFAULT_HOST, self::DEFAULT_PASS);
      }
      public static function getInstance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }

      public function getAllFrom(string $table, $asc = '_id')
      {
            $stmt = $this->PDOInstance->prepare("SELECT * FROM $table ORDER BY $table$asc ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function getOneFrom(string $table, $champ = "", $value = null)
      {
            $stmt = $this->PDOInstance->prepare("SELECT * FROM $table WHERE $champ = :value OR (1=1)");
            $stmt->execute([":value" => $value]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
      }
      public function delete(string $table,  int $id)
      {
            $stmt = $this->PDOInstance->prepare("DELETE FROM $table WHERE " . $table . "_id = :id");
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
                  $values .= htmlspecialchars($key) . "=" . "'" . htmlspecialchars($value) . "',";
            }
            // On retire juste la dernière virgule qui est de trop
            $values = substr($values, 0, -1);
            $stmt = $this->PDOInstance->prepare("UPDATE $table SET $values WHERE " . $table . "_id=:id" . $id);
            $stmt->execute([':id' => $id]);
      }
      public function add(string $table, array $value)
      {
            $sql = '(';
            foreach ($value as $k => $v) {
                  $sql .= htmlspecialchars($k) . ',';
            }
            $sql = substr($sql, 0, -1);
            $sql .= ') VALUES (';
            foreach ($value as $k => $v) {
                  $sql .= ":" . htmlspecialchars($k)  . ',';
            }
            $sql = substr($sql, 0, -1);
            $sql .= ')';
            echo $sql;
            $execute  = [];
            foreach ($value as $k => $v) {
                  $execute[':' . $k] = $v;
            }
            $stmt = $this->PDOInstance->prepare("INSERT INTO $table $sql");
            $stmt->execute($execute);
      }
      public function getFields(string $table)
      {

            $stmt = $this->PDOInstance->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE  TABLE_NAME = '".$table ."'");
            $stmt->execute();

            return  $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
}
