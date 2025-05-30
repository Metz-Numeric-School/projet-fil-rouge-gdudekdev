<?php
session_start();

define('ROOT', dirname(__DIR__));
define('REDIRECT_PROTECT_PATH', 'index.php?page=authenticate');
define("DEFAULT_DSN", "mysql:dbname=carpool;host=localhost");
define("DEFAULT_HOST", "root");
define("DEFAULT_PASS", "");

define(
      "DEPENDENCY_TABLE",

      [

            'accounts_preferences' => [
                  'depends_on' => ['accounts', 'preferences'],
                  'cascade_delete' => []
            ],

            'accounts' => [
                  'depends_on' => [],
                  'cascade_delete' => ['accounts_preferences', 'routes', 'vehicules']
            ],

            'bookings' => [
                  'depends_on' => ['instances'],
                  'cascade_delete' => []
            ],

            'car_brands' => [
                  'depends_on' => [],
                  'cascade_delete' => ['car_models']
            ],

            'car_colors' => [
                  'depends_on' => [],
                  'cascade_delete' => ['vehicules']
            ],

            'car_engines' => [
                  'depends_on' => [],
                  'cascade_delete' => ['vehicules']
            ],

            'car_models' => [
                  'depends_on' => ['car_brands'],
                  'cascade_delete' => ['vehicules']
            ],

            'divisions' => [
                  'depends_on' => ['entreprises'],
                  'cascade_delete' => []
            ],

            'entreprises' => [
                  'depends_on' => [],
                  'cascade_delete' => ['divisions']
            ],

            'instances' => [
                  'depends_on' => ['rides'],
                  'cascade_delete' => ['bookings']
            ],

            'planifications' => [
                  'depends_on' => [],
                  'cascade_delete' => ['rides']
            ],

            'preferences' => [
                  'depends_on' => [],
                  'cascade_delete' => ['accounts_preferences']
            ],

            'rides' => [
                  'depends_on' => ['routes', 'planifications','vehicules'],
                  'cascade_delete' => ['instances']
            ],

            'roles' => [
                  'depends_on' => [],
                  'cascade_delete' => []
            ],

            'routes' => [
                  'depends_on' => ['accounts'],
                  'cascade_delete' => ['rides']
            ],

            'vehicules' => [
                  'depends_on' => ['car_colors', 'car_engines', 'car_models', 'accounts'],
                  'cascade_delete' => ['rides']
            ],

      ]

);