<?php

use FastRoute\RouteCollector;

function checkSessionWeb($currentRoute)
{
    session_start();
    if ($currentRoute === '/login') {
        return;
    }
    if (!isset($_SESSION['token'])) {
        http_response_code(401);
        echo "<script>window.location.href = '/login'</script>";
        exit();
    }
}

return function (RouteCollector $r) {

    $r->addRoute('GET', '/login', function () {
        include 'views/login/login.php';
    });

    $r->addRoute('POST', '/generate-token', function () {
        include 'src/auth/generateToken.php';
    });

    $r->addRoute('GET', '/logout', function () {
        include 'src/auth/destroySession.php';
    });

    $r->addRoute('GET', '/not-found', function () {
        include 'views/404.php';
    });

    // index
    $r->addRoute('GET', '/', function () {
        checkSessionWeb('/');
        include 'views/students/students.php';
    });

};
