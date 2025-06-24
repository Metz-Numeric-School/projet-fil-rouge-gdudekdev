<?php

namespace Src\Api;

use App;
use Src\Model\Car_brands;
use Src\Model\Car_colors;
use Src\Model\Car_engines;
use Src\Model\Car_models;
use Src\Model\Rides;
use Src\Model\Vehicules;

class ApiVehicule
{

      public function request($request)
      {
            $token = Api::protectApiQuery($request);
            if (empty($request['body']['sub'])) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }
            $method = $request['body']['sub'];
            if ($query = $this->$method($request)) {
                  Api::apiResponse(['response' => $query]);
            } else {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }

      }
      public function brands($request)
      {
            return Car_brands::getAll();
      }
      public function models($request)
      {
            if (empty($request['body']['brand_id'])) {
                  return false;
            }

            $brand_id = $request['body']['brand_id'];
            return Car_models::getAllWhere('car_brands_id', $brand_id);
      }
      public function colors($request)
      {
            return Car_colors::getAll();
      }
      public function engines($request)
      {
            return Car_engines::getAll();
      }

      public function update($request)
      {
            $token = Api::protectApiQuery($request);
            if (empty($request['body']['vehicule'])) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }
            $vehicule = $request['body']['vehicule'];
            if ($query = $this->updateVehicule($token->sub, $vehicule)) {
                  Api::apiResponse(['response' => $query]);
            } else {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }
      }
      protected function updateVehicule($id, $vehicule)
      {
            $db_vehicule = [
                  'car_models_id' => $vehicule['model']['car_models_id'],
                  'car_colors_id' => $vehicule['color']['car_colors_id'],
                  'car_engines_id' => $vehicule['engine']['car_engines_id'],
                  'vehicules_license_plate' => $vehicule['plate']['immatriculation'] ?? '',
                  'accounts_id' => $id,
            ];
            return Vehicules::create($db_vehicule);
      }
      public function get($request)
      {
            $token = Api::protectApiQuery($request);

            if (empty($request['body']['rides_id'])) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }
            if ($vehicule = Rides::get($request['body']['rides_id'])) {
                  if (!$this->hasPermissionToGet($token->sub, $vehicule['vehicules_id'])) {
                        http_response_code(403);
                        Api::apiResponse(['error' => 'Permission not grantedd']);
                  }
                  if ($query = $this->getSpecificVehiculeToDisplay($vehicule['vehicules_id'])) {
                        Api::apiResponse(['response' => $query]);
                  } else {
                        http_response_code(403);
                        Api::apiResponse(['error' => 'Permission not granteddd']);
                  }
            } else {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not grantedddd']);
            }
      }

      public function hasPermissionToGet($accounts_id, $vehicules_id)
      {
            return $accounts_id == Vehicules::get($vehicules_id)['accounts_id'];
      }
      protected function getSpecificVehiculeToDisplay($id)
      {
            $sql = "SELECT v.vehicules_id, m.car_models_name as model, b.car_brands_name as brand,c.car_colors_name as color,e.car_engines_name as engine,v.vehicules_license_plate as license_plate 
                        FROM vehicules v
                        JOIN car_models m ON v.car_models_id = m.car_models_id
                        JOIN car_brands b ON m.car_brands_id = b.car_brands_id
                        JOIN car_colors c ON v.car_colors_id = c.car_colors_id
                        JOIN car_engines e ON v.car_engines_id = e.car_engines_id
                        WHERE v.vehicules_id = :vehicules_id
                        ";
            $bound = [':vehicules_id' => $id];
            return App::$db->query($sql, $bound, false);
      }
}