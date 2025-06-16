<?php

namespace Src\Api;

use App;
use Src\Model\Accounts;
use Src\Model\Accounts_preferences;

class ApiMe
{

      public function request($request)
      {

            $token = Api::protectApiQuery($request);

            if ($query = $this->dbQuery($token->sub)) {
                  Api::apiResponse(['response' => $query]);
            } else {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }

      }
      public function dbQuery($id)
      {
            $sql = "SELECT accounts_fullname, accounts_birthday, accounts_phone, accounts_email
                                FROM accounts
                               WHERE accounts_id =:id ";
            $bound = [':id' => $id];
            $userInfo = App::$db->query($sql, $bound, false);
            $sql = "SELECT preferences_id 
                      FROM accounts_preferences
                     WHERE accounts_id =:id ";
            $bound = [':id' => $id];
            $accounts_preferences = App::$db->query($sql, $bound);
            return ['accounts_info' => $userInfo, 'preferences' => \Src\Model\Preferences::getAll(), 'accounts_preferences' => $accounts_preferences];
      }

      public function update($request)
      {
            $token = Api::protectApiQuery($request);

            if (empty($request['body']['userInfo']) || empty($request['body']['userPreferences'])) {
                  var_dump('plouf');
                  http_response_code(400);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }
            if ($query = $this->updateMe($token->sub, $request['body'])) {
                  http_response_code(200);
                  Api::apiResponse(['response' => 'Informations mises à jour']);
            } else {
                  http_response_code(400);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }
      }

      protected function updateMe($id, $data)
      {
            try {
                  $accounts_info = $data['userInfo'];
                  $accounts_info['accounts_id'] = $id;

                  Accounts::update($accounts_info);

                  $preferences = [];

                  Accounts_preferences::delete(['accounts_id' => $id]);
                  foreach ($data['userPreferences'] as $pref) {
                        var_dump($id,$pref);
                        $sql = 'INSERT INTO accounts_preferences  (accounts_id, preferences_id) VALUES (:accounts_id, :preferences_id) ';
                        $bound = [':accounts_id' => $id, ':preferences_id' => $pref['preferences_id']];
                        App::$db->query($sql,$bound);
                  }
                  return true;
            } catch (e) {
                  return false;
            }


      }
}