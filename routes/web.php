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

    $r->addRoute('GET', '/alunos', function () {
        checkSessionWeb('/alunos');
        include 'views/students/students.php';
    });
    
    $r->addRoute('GET', '/alunos/criar', function () {
        checkSessionWeb('/alunos/criar');
        include 'views/students/forms/createStudents.php';
    });

    $r->addRoute('GET', '/alunos/editar/{id:\d+}', function () {
        checkSessionWeb('/alunos/editar/{id:\d+}');
        include 'views/students/edit/editStudents.php';
    });
    
    $r->addRoute('GET', '/cursos', function () {
        checkSessionWeb('/cursos');
        include 'views/courses/courses.php';
    });

    $r->addRoute('GET', '/cursos/criar', function () {
        checkSessionWeb('/cursos/criar');
        include 'views/courses/forms/createCourses.php';
    });

    $r->addRoute('GET', '/cursos/editar/{id:\d+}', function () {
        checkSessionWeb('/cursos/editar/{id:\d+}');
        include 'views/courses/edit/editCourse.php';
    });

    $r->addRoute('GET', '/matriculas', function () {
        checkSessionWeb('/matriculas');
        include 'views/enrollments/enrollments.php';
    });

    $r->addRoute('GET', '/matriculas/criar', function () {
        checkSessionWeb('/matriculas/criar');
        include 'views/enrollments/forms/createEnrollments.php';
    });

    $r->addRoute('GET', '/matriculas/editar/{id:\d+}', function () {
        checkSessionWeb('/matriculas/editar/{id:\d+}');
        include 'views/enrollments/edit/editEnrollments.php';
    });
};  
