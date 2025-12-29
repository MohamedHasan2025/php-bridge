<?php
header('Content-Type: application/json');

// Load Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../app/Controllers/ApiController.php';


// Start CodeIgniter
$app = require_once __DIR__ . '/../vendor/codeigniter4/framework/system/bootstrap.php';;

$controller = new ApiController();

// Normalize URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$endpoint = trim($uri, '/');

// Routing
switch ($endpoint) {
    case 'get-availabilities':
        $controller->sendAvailability();
        break;

    default:
        http_response_code(404);
        echo json_encode([
            'error' => true,
            'message' => 'Endpoint not found',
            'endpoint' => $endpoint
        ]);
}
