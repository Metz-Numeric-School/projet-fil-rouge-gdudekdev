<?php

namespace Src\Api;

use App;
use Src\Model\Car_brands;
use Src\Model\Car_colors;
use Src\Model\Car_engines;
use Src\Model\Car_models;

class ApiVehicule
{

      public function request($method, $request)
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
}