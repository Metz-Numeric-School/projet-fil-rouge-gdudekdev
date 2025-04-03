<?php

use App\Class\Database;
require_once '../vendor/autoload.php';

$db = Database::getInstance();
$users = $db->query("SELECT * FROM users");

foreach($users as $user){
      var_dump($user);
};