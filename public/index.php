<?php
header('Content-Type: application/json');

phpinfo();

require __DIR__ . '/../app/Controllers/ApiController.php';

$controller = new ApiController();

// Get endpoint from the URL
$uri = trim($_SERVER['REQUEST_URI'], '/'); // e.g., get-availabilities
$parts = explode('?', $uri);              // remove query string
$endpoint = $parts[0];

// Read POST JSON body
$input = json_decode(file_get_contents('php://input'), true) ?: $_POST ?: $_GET;

// Simple routing
switch ($endpoint) {
    case 'get-availabilities':
        $controller->sendAvailability();
        break;
    default:
        echo json_encode(['error' => true, 'message' => 'Endpoint not found']);
}
