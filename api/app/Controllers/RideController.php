<?php
namespace App\Controllers;
use App\Models\Ride;
class RideController {
    private $ride;

    public function __construct() {
        $this->ride = new Ride();
    }

    // ✅ Créer un trajet
    public function createRide($driver_id, $departure, $destination, $departure_time, $seats_available, $price) {
        if ($this->ride->createRide($driver_id, $departure, $destination, $departure_time, $seats_available, $price)) {
            echo json_encode(["message" => "Trajet créé avec succès"]);
        } else {
            echo json_encode(["error" => "Erreur lors de la création du trajet"]);
        }
    }

    // ✅ Récupérer tous les trajets
    public function getAllRides() {
        $rides = $this->ride->getAllRides();
        echo json_encode($rides);
    }

    // ✅ Récupérer un trajet par ID
    public function getRideById($id) {
        $ride = $this->ride->getRideById($id);
        if ($ride) {
            echo json_encode($ride);
        } else {
            echo json_encode(["error" => "Trajet non trouvé"]);
        }
    }

    // ✅ Supprimer un trajet
    public function deleteRide($id) {
        if ($this->ride->deleteRide($id)) {
            echo json_encode(["message" => "Trajet supprimé avec succès"]);
        } else {
            echo json_encode(["error" => "Erreur lors de la suppression du trajet"]);
        }
    }
}
?>
