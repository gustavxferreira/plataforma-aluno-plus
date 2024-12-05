<?php

use Illuminate\Http\JsonResponse;

function json_response($data, $status = 200): JsonResponse
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function destroySession()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    unset($_SESSION['token']);
    session_destroy();
}




function view($view, $withLayout = true)
{
    checkSessionWeb();

    ob_start();
    $viewPath = dirname(__DIR__, 2) . "/views/" . str_replace('.', '/', $view) . ".view.php";

    require $viewPath;

    $content = ob_get_clean();

    if (!$withLayout) {
        echo $content;
        return;
    }

    require dirname(__DIR__, 2) . "/views/layouts/app.view.php";
}

function checkSessionWeb()
{
    $uri = $_SERVER['REQUEST_URI'];
    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }

    if ($uri === '/login' || $uri === '/not-found') {
        return;
    }

    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['token'])) {
        http_response_code(401);
        header('Location: /login');
        exit();
    }
}

function startSection($name)
{
    $sections = [];
    ob_start();
    global $sections;
    $sections[$name] = '';
}

function yieldSection($name)
{
    global $sections;
    if (isset($sections[$name])) {
        echo $sections[$name];
    }
}

function endSection($name)
{
    global $sections;
    $sections[$name] = ob_get_clean();
}

function abort($code)
{
    http_response_code($code);

    switch ($code) {
        case 404:
            header('Location: /not-found');
            exit();
            break;
        case 405:
            // require dirname(__DIR__, 2) . '/views/errors/405.view.php';
            exit();
            break;
        default:
            // require dirname(__DIR__, 2) . '/views/errors/500.view.php';
            exit();
            break;
    }
}
