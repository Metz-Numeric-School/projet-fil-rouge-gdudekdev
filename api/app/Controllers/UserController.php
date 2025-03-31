<?php
namespace App\Controllers;
use App\Models\User;
use Config\JWTHandler;


class UserController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    // Inscription
    public function register($name, $email, $password) {
        header('Content-Type: application/json');
        echo json_encode(["message" => "Inscription réussie."]);
        exit;
        if ($this->user->register($name, $email, $password)) {
            echo json_encode(["message" => "Inscription réussie"]);
        } else {
            echo json_encode(["error" => "Erreur lors de l'inscription"]);
        }
    }

    // Connexion avec JWT
    public function login($email, $password) {
        $user = $this->user->login($email, $password);
        if ($user) {
            $token = JWTHandler::generateToken($user['id'], $user['email']);
            echo json_encode([
                "message" => "Connexion réussie",
                "token" => $token
            ]);
        } else {
            echo json_encode(["error" => "Identifiants incorrects"]);
        }
    }
}

