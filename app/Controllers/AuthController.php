<?php

namespace App\Controllers;

use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController
{
    public function generateToken(Request $request)
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();

        $username = strip_tags($request->input('name'));
        $password = strip_tags($request->input('password'));

        $userFound = Teacher::where('name', $username)->first();

        if (!$userFound) {
            http_response_code(401);
        } else if (!password_verify($password,  $userFound['password'])) {
            http_response_code(401);
        } else {
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
    }

    public static function verifyToken()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();

        $headers = apache_request_headers();

        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            return [false, null, null];
        }

        $authorization = $headers['Authorization'];
        $token = str_replace('Bearer ', '', $authorization);
        $decoded = null;

        try {
            $key = $_ENV['KEY'];
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            $username = $decoded->username;
            return [true, $decoded, $username];
        } catch (Exception $e) {
            http_response_code(401);
            return [false, $e->getMessage(), null];
        }
    }

    public static function checkAuth($uri)
    {

        if ($uri === '/api/generate-token' || $uri === '/api/logout') {
            return true;
        }

        if (strpos($uri, '/api') === 0) {

            [$token, $message] = self::verifyToken();

            if (!$token) {
                $acceptHeader = $_SERVER['HTTP_ACCEPT'] ?? '';

                if (strpos($acceptHeader, 'text/html') !== false) {
                    header('Location: /login');
                    exit();
                }
                return json_response(['Token' => $message], 401);
            }
        }
        return true;
    }
}
