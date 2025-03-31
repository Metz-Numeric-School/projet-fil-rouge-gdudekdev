<?php
namespace Config;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTHandler {
    private static $secret_key = "votre_cle_secrete"; //TODO Remplacer la clé
    private static $algorithm = "HS256";

    // Générer un token JWT
    public static function generateToken($user_id, $email) {
        $payload = [
            "iss" => "http://localhost",  // Émetteur
            "iat" => time(),              // Temps d'émission
            "exp" => time() + 3600,       // Expiration (1 heure)
            "user_id" => $user_id,
            "email" => $email
        ];

        return JWT::encode($payload, self::$secret_key, self::$algorithm);
    }

    // Vérifier et décoder un token JWT
    public static function verifyToken($token) {
        try {
            return JWT::decode($token, new Key(self::$secret_key, self::$algorithm));
        } catch (Exception $e) {
            return false;
        }
    }
}

