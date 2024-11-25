<?php

use FastRoute\RouteCollector;

return function (RouteCollector $r) {

    $r->addRoute('GET', '/api/students', 'StudentsController@index');
    $r->addRoute('POST', '/api/students', 'StudentsController@store');
    $r->addRoute('GET', '/api/students/{id:\d+}', 'StudentsController@show');
    $r->addRoute('DELETE', '/api/students/{id:\d+}', 'StudentsController@destroy');
    $r->addRoute('PUT', '/api/students/{id:\d+}', 'StudentsController@update');

    $r->addRoute('GET', '/api/courses', 'CoursesController@index');
    $r->addRoute('POST', '/api/courses', 'CoursesController@store');
    $r->addRoute('GET', '/api/courses/{id:\d+}', 'CoursesController@show');
    $r->addRoute('PUT', '/api/courses/{id:\d+}', 'CoursesController@update');

    $r->addRoute('GET', '/api/enrollments', 'EnrollmentsController@index');
    $r->addRoute('GET', '/api/enrollments/{id:\d+}', 'EnrollmentsController@show');
    $r->addRoute('POST', '/api/enrollments', 'EnrollmentsController@store');
    $r->addRoute('PATCH', '/api/enrollments/{id:\d+}', 'EnrollmentsController@update');
    $r->addRoute('DELETE', '/api/enrollments/{id:\d+}', 'EnrollmentsController@destroy');
};
