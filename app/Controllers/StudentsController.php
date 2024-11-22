<?php

namespace App\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class StudentsController
{

    public function index(Request $request, $vars)
    {
        try {
            $response = Student::all();
            return json_response($response);
        } catch (Exception $e) {
            return json_response(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        }
    }
}
