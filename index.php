<?php

require 'vendor/autoload.php';

use App\Controllers\AuthController;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Illuminate\Http\Request;

date_default_timezone_set('America/Sao_Paulo');

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    (require 'routes/web.php')($r);
    (require 'routes/api.php')($r);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = strtok($_SERVER['REQUEST_URI'], '?');

$request = Request::createFromGlobals();

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {

    case FastRoute\Dispatcher::NOT_FOUND:
        abort(404);
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        abort(405);
        break;

    case FastRoute\Dispatcher::FOUND:

        $auth = AuthController::checkAuth($uri);

        if (!$auth) {
            return;
        }

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

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
