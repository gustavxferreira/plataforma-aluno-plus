<?php

require 'vendor/autoload.php';

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    (require 'routes/web.php')($r);
    (require 'routes/api.php')($r);
});
date_default_timezone_set('America/Sao_Paulo');

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$request = Request::createFromGlobals();

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

function checkSessionApi()
{
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Authorization, Content-Type, x-xsrf-token, x_csrftoken, Cache-Control, X-Requested-With');

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $headers = apache_request_headers();

    // Verifica se o cabeçalho de autorização está presente
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        return [false, null, null]; // Retorna false se o cabeçalho não estiver presente
    }

    $authorization = $headers['Authorization'];
    $token = str_replace('Bearer ', '', $authorization);
    $decoded = null;

    try {
        $key = $_ENV['KEY'];
        $decoded = JWT::decode($token, new Key($key, 'HS256'));

        $username = $decoded->username ?? null;

        return [true, $decoded, $username];
    } catch (Exception $e) {
        http_response_code(401);
        return [false, $e->getMessage(), null];
    }
}

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:

        http_response_code(404);
        echo "<script>window.location.href = '/not-found'</script>";
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];

        http_response_code(405);
        echo "<script>window.location.href = '/not-found'</script>";
        exit();
        break;

    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // Verificando se a rota começa com '/api' para validar o token
        if (strpos($uri, '/api') === 0) {
            // desestrutura da function o token e a mensagem 
            [$verifyToken, $message] = checkSessionApi();
            // caso não houver token ou nao for válido trata-se aqui
            if (!$verifyToken) {
                http_response_code(401);
                echo "<script>window.location.href = '/not-found'</script>";
                exit();
            }
        }

        if (is_string($handler)) {
            [$controller, $method] = explode('@', $handler);
            $controller = 'App\\Controllers\\' . $controller;
            $controllerInstance = new $controller();
            $request = Request::capture();
            echo call_user_func([$controllerInstance, $method], $request, $vars);
        } elseif (is_callable($handler)) {
            echo $handler($request, $vars);
        }

        break;
}
