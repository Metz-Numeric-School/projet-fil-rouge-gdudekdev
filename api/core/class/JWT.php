<?php 
namespace Core\Class;

use Exception;
use Firebase\JWT\JWT as JWTJWT;
use Firebase\JWT\Key;

class JWT
{
    private $privateKey;  // Clé privée pour signer les tokens
    private $publicKey;   // Clé publique pour vérifier les tokens

    private $payload = array(
        "iss" => "http://carpool",  
        "aud" => "http://localhost:5173",
        "iat" => null,          
        "exp" => null           
    );

    public function __construct($user_id = null) {
        $this->privateKey = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/privkey.pem');  // Charger la clé privée
        $this->publicKey = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/pubkey.pem');    // Charger la clé publique

        // Ajouter des informations de payload
        $this->payload['iat'] = time();
        $this->payload['exp'] = time() + 3600;  // Durée de validité du token (1 heure)

        // Ajouter des données spécifiques à l'utilisateur
        $this->payload['data'] = array(
            "userId" => $user_id,
        );
    }

    // Encoder un token JWT avec la clé privée (RS256) et ajouter un "kid"
    public function encode()
    {
        try {
            $header = ['kid' => 'carpool-key-id']; 
            return JWTJWT::encode($this->payload, $this->privateKey, 'RS256', null, $header);
        } catch (Exception $e) {
            echo "Erreur lors de l'encodage du JWT : " . $e->getMessage();
            return null;
        }
    }

    // Décoder le token avec la clé publique (RS256)
    public function decode($jwt)
    {
        try {
            $decoded = JWTJWT::decode($jwt, new Key($this->publicKey, 'RS256'));
            return $decoded;
        } catch (Exception $e) {
            echo "Erreur de validation du token : " . $e->getMessage();
            return null;
        }
    }
}
