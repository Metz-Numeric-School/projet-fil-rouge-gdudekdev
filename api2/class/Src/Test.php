<?php

namespace Src;

class Test
{
      public static function test()
      {
            $test = [
                  'email' => 'admin',
                  'password' => 1234,
            ];
            return json_encode($test);
      }
      public static function token()
      {
            return "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImtpZCI6ImNhcnBvb2wta2V5LWlkLWdkdWRlay1kZXYifQ.eyJpc3MiOiJodHRwOi8vY2FycG9vbCIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3Q6NTE3MyIsImlhdCI6MTc0ODkzNTU3MiwiZXhwIjoxNzQ4OTM5MTcyLCJzdWIiOjF9.0WxFPnfovEKPzWQf67gOJalE6x9cxOvYZBe0chDTKAN2Xai2_dzEHKUoQW1MO4RtYDaSjqG0i91Na2SJU15px8HvbG-lrJg-7KaHZWFF7ODyVb4G2aFlHfzoZq5jrUK1n3Wi8_YC0p0gsQ_0ocDgteXNFv79NtUKEP9cRtMLI6gR0u8mnXBVCCTJLFfP-l98jpziS_DS_D0I92_DKq9d7P_wVHsPLaliAzb9WipCKXWJrhhYUUDVlx5iseHk55TYUYfMVwvUaFlIcaAd-uEJTjJKKJzdVHu2TxXIt0ssVi6mZKlEFpSstXgI4HHd9-W46avWoZNpu1USYL26kIPtRA";
      }
      // TODO faire des test d'envoi et de récupération de refresh token (ne pas oublier le credentials include)
      public static function test_img($id)
      {
            $file_path = ROOT . '/upload/' . $id . '/';
            if(!file_exists($file_path)){
                  mkdir($file_path);
            }

            if(file_exists($file_path . 'profile.jpg')){
                  echo 'pas d\'image de profil sauvegardé';
            }
            if(!isset($_FILES['accounts_profile'])){
                  echo 'aucune image de profil envoyé';
            }

            move_uploaded_file($_FILES['accounts_profile']['tmp_name'], $file_path . 'profile.jpg');
            var_dump($_FILES);
      }
}