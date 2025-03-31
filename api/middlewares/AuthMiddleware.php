<?php
namespace Middlewares;
use Config\JWTHandler;

class AuthMiddleware {
    public static function checkAuth() {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            echo json_encode(["error" => "Accès non autorisé, token manquant"]);
            http_response_code(401);
            exit();
        }

        $token = str_replace("Bearer ", "", $headers['Authorization']);
        $decoded = JWTHandler::verifyToken($token);

        if (!$decoded) {
            echo json_encode(["error" => "Token invalide"]);
            http_response_code(401);
            exit();
        }

        return $decoded;
    }
}

