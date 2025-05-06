<?php
// api/calculate.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Read input
$data = json_decode(file_get_contents('php://input'), true);
$origin = isset($data['origin']) && trim($data['origin']) !== '' ? $data['origin'] : 'Add Address here';
$destination = $data['destination'] ?? '';

if (!$destination) {
    echo json_encode(['error' => 'Destination is required.']);
    exit;
}

$config = include('env.php');
$apiKey = $config['GOOGLE_MAPS_API_KEY'];

$queryParams = [
    'origins' => $origin,
    'destinations' => $destination,
    'units' => 'imperial',
    'key' => $apiKey
];

$url = 'https://maps.googleapis.com/maps/api/distancematrix/json?' . http_build_query($queryParams);

$response = file_get_contents($url);
if ($response === false) {
    echo json_encode(['error' => 'Request to Google Maps API failed.']);
    exit;
}

$json = json_decode($response, true);

// Optional debug log (disable in production)
file_put_contents(__DIR__ . '/log.txt', json_encode([
    'url' => $url,
    'api_response' => $json
], JSON_PRETTY_PRINT));

if ($json['status'] !== 'OK') {
    echo json_encode([
        'error' => 'Google Maps API error.',
        'details' => $json
    ]);
    exit;
}

$element = $json['rows'][0]['elements'][0];
if ($element['status'] !== 'OK') {
    echo json_encode([
        'error' => 'Invalid location.',
        'details' => $element['status']
    ]);
    exit;
}

echo json_encode([
    'distanceMeters' => $element['distance']['value'],
    'distanceText' => $element['distance']['text']
]);