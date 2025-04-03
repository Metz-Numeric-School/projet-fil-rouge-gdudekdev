<?php

namespace App\Models;

use App\Config\Database;
use Throwable, Exception;

class Users
{
      private $db;

      public function __construct()
      { {
                  $this->db = Database::getInstance();
            }
      }
      public function getById($id)
      {
            return $this->db->preparedQuery("SELECT * FROM users WHERE id=?", [$id]);
      }
      public function getAll()
      {
            return $this->db->query("SELECT * FROM users");
      }
      public function create($user)
      {
            try {
                  $result = $this->db->preparedQuery(
                        "INSERT INTO users (name, email, password) VALUES (?, ?, ?)",
                        $user
                  );
                  if ($result) {
                        return ['success' => true, 'message' => 'Utilisateur créé avec succès.'];
                  }
            } catch (Throwable $e) {
                  throw new Exception('L\'adresse email est déjà utilisée.');
            }
            return ['success' => false, 'message' => 'Échec de la création de l\'utilisateur.'];
      }
      public function update($id, $user)
      {
            $result = $this->db->preparedQuery(
                  "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?",
                  [...$user, $id]
            );
            if ($result) {
                  return ['success' => true, 'message' => 'Utilisateur mis à jour avec succès.'];
            }
            return ['success' => false, 'message' => 'Échec de la mise à jour de l\'utilisateur.'];
      }
      public function delete($id)
      {
            $result = $this->db->preparedQuery("DELETE FROM users WHERE id = ?", [$id]);
            if ($result) {
                  return ['success' => true, 'message' => 'Utilisateur supprimé avec succès.'];
            }
            return ['success' => false, 'message' => 'Échec de la suppression de l\'utilisateur.'];
      }

      public function handleAction($action, $data)
      {
            switch ($action) {
                  case 'create':
                        return $this->create($data);
                  case 'update':
                        $id = $data['id'] ?? null;
                        unset($data['id']);
                        return $this->update($id, $data);
                  case 'delete':
                        return $this->delete($data['id']);
                  default:
                        throw new Exception('Action non reconnue.');
            }
      }
}