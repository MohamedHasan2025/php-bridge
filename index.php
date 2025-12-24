<?php
header('Content-Type: application/json');

// Read JSON body
$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

// Fallback to GET/POST params
if (empty($data)) {
    $data = $_REQUEST;
}

// CHANGE THIS URL
$targetUrl = 'https://second-api.com/endpoint';

$ch = curl_init($targetUrl);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => $_SERVER['REQUEST_METHOD'],
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
    ],
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    echo json_encode([
        'error' => true,
        'message' => $error
    ]);
    exit;
}

echo $response;
