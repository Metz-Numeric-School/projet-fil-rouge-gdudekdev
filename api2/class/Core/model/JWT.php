<?php

namespace Core\Model;

use App;
use Exception;
use Firebase\JWT\Key;
use Src\Api\Api;

class JWT
{
    private static $privateKey;
    private static $publicKey;
    private static $instance = null;

    public function __construct()
    {
        self::$privateKey = file_get_contents(ROOT . '/config/privkey.pem');
        self::$publicKey = file_get_contents(ROOT . '/config/pubkey.pem');
    }
    public static function instance()
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    public function getTokens($id)
    {
        $this->createRefreshToken($id);
        $this->createAccessToken($id);
    }

    public function encode($payload)
    {
        try {
            return \Firebase\JWT\JWT::encode($payload, self::$privateKey, 'RS256', 'carpool-key-id-gdudek-dev');
        } catch (Exception $e) {
            echo "Erreur lors de l'encodage du JWT : " . $e->getMessage();
            return null;
        }
    }

    public function decode($jwt)
    {
        try {
            return \Firebase\JWT\JWT::decode($jwt, new Key(self::$publicKey, 'RS256'));
        } catch (Exception $e) {
            return false;
        }
    }

    public function createAccessToken($id)
    {
        $payload = [
            'iat' => time(),
            'exp' => time() + 900,
            'sub' => $id,
            'iss' => 'http://localhost:5173'
        ];
        echo json_encode(
            [
                'access_token' => $this->encode($payload),
            ]
        );
    }
    public function createRefreshToken($id)
    {
        $token = bin2hex(random_bytes(64));
        $hash = hash('sha256', $token);
        $expiration_date = date('Y-m-d H:i:s', time() + 604800);
        setcookie("refresh_token" , $token, [
            'path'=> '/',
            'secure'=> false,
            'httponly'=> true,
            'expires' => time() + 604800,
            'domain' => 'carpool',
            'sameSite'=> 'Strict',
        ]);
        App::$db->add(
            'tokens',
            [
                'tokens_hash' => $hash,
                'accounts_id' => $id,
                'tokens_expires_at' => $expiration_date,
                'tokens_ip_adress' => $_SERVER['REMOTE_ADDR'],
                'tokens_user_agent' => $_SERVER['HTTP_USER_AGENT']
            ]
        );
        

    }
    public function refresh()
    {
        $tokenHash = hash('sha256', $_COOKIE['refresh_token']);
        $token = App::$db->getAllFromWhere('tokens', ['stmt' => 'tokens_hash=:hash AND tokens_revoked = 0', 'params' => [':hash' => $tokenHash]]);

        if (empty($token)|| strtotime($token[0]['tokens_expires_at']) < time()) {
            Api::apiResponse(['error' => 'Invalid or expired token']);
        }

        $this->createAccessToken($token[0]['accounts_id']);
    }
}
