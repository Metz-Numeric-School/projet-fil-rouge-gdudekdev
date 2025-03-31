<?php
namespace Routes;
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\UserController;
use App\Controllers\RideController;
use Middlewares\AuthMiddleware;

header("Content-Type: application/json");
$request_method = $_SERVER["REQUEST_METHOD"];
$rideController = new RideController();
$userController = new UserController();

// ✅ Route d'inscription (publique)
if ($_SERVER["REQUEST_URI"] == "/api/register" && $request_method == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $userController->register($data['name'], $data['email'], $data['password']);
}

// ✅ Route de connexion (publique)
if ($_SERVER["REQUEST_URI"] == "/api/login" && $request_method == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $userController->login($data['email'], $data['password']);
}

// ✅ Route protégée pour récupérer tous les trajets (nécessite JWT)
if ($_SERVER["REQUEST_URI"] == "/api/rides" && $request_method == "GET") {
    AuthMiddleware::checkAuth(); // Vérifie le JWT avant d'exécuter la requête
    $rideController->getAllRides();
}

// ✅ Route protégée pour créer un trajet (nécessite JWT)
if ($_SERVER["REQUEST_URI"] == "/api/rides" && $request_method == "POST") {
    $user = AuthMiddleware::checkAuth(); // Vérifie le JWT avant d'exécuter la requête
    $data = json_decode(file_get_contents("php://input"), true);
    $rideController->createRide(
        $user->user_id,  // ID récupéré depuis le token
        $data['departure'], 
        $data['destination'], 
        $data['departure_time'], 
        $data['seats_available'], 
        $data['price']
    );
}

