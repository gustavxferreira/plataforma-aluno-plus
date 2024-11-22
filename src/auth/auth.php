<?php

require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization, Content-Type, x-xsrf-token, x_csrftoken, Cache-Control, X-Requested-With');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$headers = apache_request_headers();

if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$authorization = $headers['Authorization'];
$token = str_replace('Bearer ', '', $authorization);

try {
    $key = $_ENV['KEY'];
    
    $decoded = JWT::decode($token, new Key($key, 'HS256'));
    
    $decodedArray = (array) $decoded;
    
    $decodedArray['username'] = $decodedArray['username'] ?? null;
    echo json_encode($decodedArray);
    
} catch (\Firebase\JWT\ExpiredException $e) {

    http_response_code(401);
    echo json_encode(['error' => 'EXPIRED']);
} catch (\Firebase\JWT\SignatureInvalidException $e) {

    http_response_code(401);
    echo json_encode(['error' => 'INVALID']);
} catch (Throwable $e) {

    http_response_code(401);
    echo json_encode(['error' => 'INVALID']);
}
?>
