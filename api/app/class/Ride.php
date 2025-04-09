<?php 
namespace App\Class;
class Ride {
      private $id = 0;
      private $driver = 0;
      private $departure = '';
      private $destination = '';
      private $created_at = '';
      private $departure_time = '';
      private $available_seats = '';
      private $users_id = '';

      public function __construct($data = null)
      {
            if ($data) {
                  $this->hydrate($data);
            }
      }

      private function hydrate($data)
      {
            $this->setId($data['rides_id']);
            $this->setDriver($data['rides_driver']);
            $this->setDeparture($data['rides_departure']);
            $this->setDestination($data['rides_destination']);
            $this->setCreated_at($data['rides_created_at']);
            $this->setDeparture_time($data['rides_departure_time']);
            $this->setAvailable_seats($data['rides_available_seats']);
            $this->setUsers_id($data['users_id']);
      }
      
      public function getData(){
            return ['rides_id'=>$this->id(),'rides_driver'=>$this->driver(),'rides_departure'=>$this->departure(),'rides_destination'=>$this->destination(),'rides_created_at'=>$this->created_at(),'rides_departure_time'=>$this->departure_time(),'rides_available_seats'=>$this->available_seats(),'users_id'=>$this->users_id()];
      }
      public function id(){
            return htmlspecialchars($this->id);
      }
      public function setId($value){
            $value>0 ? $this->id = $value : $this->id = 0;
      }
      public function driver(){
            return htmlspecialchars($this->driver);
      }
      public function setDriver($value){
            $value>0 ? $this->driver = $value : $this->driver = 0;
      }
      public function departure(){
            return htmlspecialchars($this->departure);
      }
      public function setDeparture($value){
            $value>0 ? $this->departure = $value : $this->departure = 0;
      }
      public function destination(){
            return htmlspecialchars($this->destination);
      }
      public function setDestination($value){
            $value>0 ? $this->destination = $value : $this->destination = 0;
      }
      public function created_at(){
            return htmlspecialchars($this->created_at);
      }
      public function setCreated_at($value){
            $value>0 ? $this->created_at = $value : $this->created_at = 0;
      }
      public function departure_time(){
            return htmlspecialchars($this->departure_time);
      }
      public function setDeparture_time($value){
            $value>0 ? $this->departure_time = $value : $this->departure_time = 0;
      }
      public function available_seats(){
            return htmlspecialchars($this->available_seats);
      }
      public function setavailable_seats($value){
            $value>0 ? $this->available_seats = $value : $this->available_seats = 0;
      }
      public function users_id(){
            return htmlspecialchars($this->users_id);
      }
      public function setUsers_id($value){
            $value>0 ? $this->users_id = $value : $this->users_id = 0;
      }

}
