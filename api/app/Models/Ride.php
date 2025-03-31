<?php
namespace App\Models;

use Core\Database;
use PDO;

class Ride {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function createRide($driver_id, $departure, $destination, $departure_time, $seats_available, $price) {
        $sql = "INSERT INTO rides (driver_id, departure, destination, departure_time, seats_available, price)
                VALUES (:driver_id, :departure, :destination, :departure_time, :seats_available, :price)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'driver_id' => $driver_id,
            'departure' => $departure,
            'destination' => $destination,
            'departure_time' => $departure_time,
            'seats_available' => $seats_available,
            'price' => $price
        ]);
    }

    public function getAllRides() {
        $sql = "SELECT * FROM rides";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRideById($id) {
        $sql = "SELECT * FROM rides WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteRide($id) {
        $sql = "DELETE FROM rides WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>
