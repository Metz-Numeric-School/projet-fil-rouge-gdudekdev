<?php

namespace Core\Model;

use Exception;
use Firebase\JWT\Key;

class JWT
{
    private $privateKey;  
    private $publicKey;  
    private $payload = array(
        "iss" => "http://carpool",
        "aud" => "http://localhost:5173",
        "iat" => null,
        "exp" => null
    );

    public function __construct($id = null)
    {
        $this->privateKey = file_get_contents(ROOT . '/config/privkey.pem');  
        $this->publicKey = file_get_contents(ROOT . '/config/pubkey.pem');

        $this->payload['iat'] = time();
        $this->payload['exp'] = time() + 3600;  

        $this->payload['data'] = array(
            "id" => $id,
        );
    }

    public function encode()
    {
        try {
            $header = ['kid' => 'carpool-key-id'];
            return \Firebase\JWT\JWT::encode($this->payload, $this->privateKey, 'RS256', null, $header);
        } catch (Exception $e) {
            echo "Erreur lors de l'encodage du JWT : " . $e->getMessage();
            return null;
        }
    }

    public function decode($jwt)
    {
        try {
            return \Firebase\JWT\JWT::decode($jwt, new Key($this->publicKey, 'RS256'));
        } catch (Exception $e) {
            return "Erreur de validation du token : " . $e->getMessage();
        }
    }
}
