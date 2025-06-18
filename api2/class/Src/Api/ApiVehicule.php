<?php

namespace Src\Api;

use App;
use Src\Model\Car_brands;
use Src\Model\Car_colors;
use Src\Model\Car_engines;
use Src\Model\Car_models;
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
                  'car_models_id' =>$vehicule['model']['car_models_id'],
                  'car_colors_id' =>$vehicule['color']['car_colors_id'],
                  'car_engines_id' =>$vehicule['engine']['car_engines_id'],
                  'vehicules_license_plate' =>$vehicule['plate']['immatriculation'] ?? '',
                  'accounts_id' => $id,
            ];
            return Vehicules::create($db_vehicule);
      }
}