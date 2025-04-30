<?php 
session_start();
define( 'TABLE_GROUP' , [
      'accounts' => [
            'companies',
            'plannings',
            'preferences',
            'routes'
      ],
      'rides' => [
            'bookings',

      ],
      'messages' => [
            'messages'
      ],
      'vehicules' => [
            'car_brands',
            'car_colors',
            'car_models'
      ],
      'others' => [
            'ratings'
      ]
]);
define('BACK_MANAGED_TABLE',[
      'accounts',
]);
define('REDIRECT_PROTECT_PATH', 'index.php?page=authentificate');