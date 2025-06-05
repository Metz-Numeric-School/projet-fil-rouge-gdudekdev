<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// définir un cookie
setcookie('refresh_token', 'abc123', [
    'expires' => time() + 3600,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax'
]);


echo json_encode(['status' => 'cookie set']);