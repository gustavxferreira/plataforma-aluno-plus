<?php

use FastRoute\RouteCollector;

return function (RouteCollector $r) {

    $r->addRoute('GET', '/login', fn() => view('login.login', false));

    $r->addRoute('GET', '/logout', function () {
        destroySession();
        header('Location: /login');
        exit();
    });

    $r->addRoute('GET', '/not-found', fn() => view('errors.404', false));

    // index
    $r->addRoute('GET', '/', fn() => view('students.students'));

    $r->addRoute('GET', '/alunos', fn() => view('students.students'));
    $r->addRoute('GET', '/alunos/criar', fn() => view('students.forms.createStudents'));
    $r->addRoute('GET', '/alunos/editar/{id:\d+}', fn() => view('students.edit.editStudents'));

    $r->addRoute('GET', '/cursos', fn() => view('courses.courses'));
    $r->addRoute('GET', '/cursos/criar', fn() => view('courses.forms.createCourses'));
    $r->addRoute('GET', '/cursos/editar/{id:\d+}', fn() => view('courses.edit.editCourse'));

    $r->addRoute('GET', '/matriculas', fn() => view('enrollments.enrollments'));
    $r->addRoute('GET', '/matriculas/criar', fn() => view('enrollments.forms.createEnrollments'));
    $r->addRoute('GET', '/matriculas/editar/{id:\d+}', fn() => view('enrollments.edit.editEnrollments'));

};  
