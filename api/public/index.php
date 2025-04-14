<?php 
$allowedOrigin = "http://localhost:5173";
$requestOrigin = $_SERVER['HTTP_ORIGIN'] ?? null;

if ($requestOrigin === $allowedOrigin) {
    header("Access-Control-Allow-Origin: $allowedOrigin");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type,Authorization");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        foreach ($_POST as $data) {
            var_dump($data);
        }
    }


} else {
    header("Location: ../app/model/index.php");
    exit();
}
?>
