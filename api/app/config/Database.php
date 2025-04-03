<?php 
namespace App\Config;
use PDO, Exception;

class Database
{
      private static $instance = null;
      private $db;

      private function __construct()
      {
            try {
                  $this->db = new PDO('mysql:host=localhost;dbname=carpool;charset=utf8', 'root', '');
                  $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                  die($e->getMessage());
            }
      }

      public static function getInstance()
      {
            if (self::$instance === null) {
                  self::$instance = new self();
            }
            return self::$instance;
      }

      public function getConnection()
      {
            return $this->db;
      }

      public function __clone() {}  // Empêche le clonage
      public function __wakeup() {} // Empêche la désérialisation
      
      public function query($sql){
            try {
                  return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                  throw new Exception("Erreur lors de l'exécution de la requête : " . $e->getMessage());
            }
      }

      public function preparedQuery($sql, $params = []){
            try {
                  $stmt = $this->db->prepare($sql);
                  $stmt->execute($params);
                  return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                  throw new Exception("Erreur lors de l'exécution de la requête préparée : " . $e->getMessage());
            }
      }
}
