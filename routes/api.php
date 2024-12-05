<?php

use FastRoute\RouteCollector;

return function (RouteCollector $r) {
    
    $r->addGroup('/api', function (RouteCollector $r) { 
        
        $r->addRoute('POST', '/logout', 'AuthController@logout');
        $r->addRoute('POST', '/generate-token', 'AuthController@generateToken');

        $r->addRoute('GET', '/students', 'StudentsController@index');
        $r->addRoute('POST', '/students', 'StudentsController@store');
        $r->addRoute('GET', '/students/{id:\d+}', 'StudentsController@show');
        $r->addRoute('DELETE', '/students/{id:\d+}', 'StudentsController@destroy');
        $r->addRoute('PUT', '/students/{id:\d+}', 'StudentsController@update');
    
        $r->addRoute('GET', '/courses', 'CoursesController@index');
        $r->addRoute('POST', '/courses', 'CoursesController@store');
        $r->addRoute('GET', '/courses/{id:\d+}', 'CoursesController@show');
        $r->addRoute('PUT', '/courses/{id:\d+}', 'CoursesController@update');
    
        $r->addRoute('GET', '/enrollments', 'EnrollmentsController@index');
        $r->addRoute('GET', '/enrollments/{id:\d+}', 'EnrollmentsController@show');
        $r->addRoute('POST', '/enrollments', 'EnrollmentsController@store');
        $r->addRoute('PATCH', '/enrollments/{id:\d+}', 'EnrollmentsController@update');
        $r->addRoute('DELETE', '/enrollments/{id:\d+}', 'EnrollmentsController@destroy');
    });
};
