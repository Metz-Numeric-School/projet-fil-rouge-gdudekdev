<?php
// TODO a améliorer pour rajouter plus de dossier de class , séparation des Manager et des class standard sinon ça va être le bordel

spl_autoload_register(function ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/class/' . $class_name . '.php';
});


// CONFIG
$value = [
    'users' => 'Utilisateurs',
    'rides' => 'Trajets',
];
define("TABLE_CONFIG", $value);