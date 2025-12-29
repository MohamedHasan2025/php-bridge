<?php
header('Content-Type: application/json');

require __DIR__ . '/../app/Controllers/ApiController.php';
require __DIR__ . '/../vendor/autoload.php';

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
