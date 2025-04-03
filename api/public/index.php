<?php
require_once '../vendor/autoload.php';

$page = $_GET['page'] ?? 'home';

$allowed_pages = ['home', 'users'];

if (!in_array($page, $allowed_pages)) {
    $page = 'home'; // Redirection vers une page par défaut si la page n'est pas autorisée
}

// Charger le contenu de la page
ob_start();
include "../app/views/$page.php";
$content = ob_get_clean();

include './../template/basic.php';
?>

