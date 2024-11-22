<?php

require 'vendor/autoload.php';

use App\Models\Teacher;
use Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Access-Control-Allow-Headers: Authorization, Content-Type, x-xsrf-token, x_csrftoken, Cache-Control, X-Requested-With');

$headers = apache_request_headers();

$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

$username = strip_tags($_POST['name']);
$password = strip_tags($_POST['password']);

$userFound = Teacher::where('name', $username)->first();

if (!$userFound) {
    http_response_code(401);
} 
else if (!password_verify($password,  $userFound['password'])){
    http_response_code(401);
}
else {
    $issueAt = time();
    $expirationTime = $issueAt + 21600; 
    
    $payload = [
        "username" => $username,
        "exp" => $expirationTime,
        "iat" => $issueAt
    ];

    $token = JWT::encode($payload, $_ENV['KEY'], 'HS256');
    session_start();
    $_SESSION['token'] = $token;

    echo json_encode($token);
}
