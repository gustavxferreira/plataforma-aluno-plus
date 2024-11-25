<?php

namespace App\Controllers;

use App\Models\Student;
use App\Request\StudentRequest;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentsController
{
    public function index(): JsonResponse
    {
        try {
            $response = Student::orderBy('birthdate', 'desc')->get();
            return json_response($response);
        } catch (Exception $e) {
            return json_response(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        }
    }
    public function show(Request $request, $vars): JsonResponse
    {
        $id = (int) $vars['id'];
        try {
            $response = Student::with(['enrollments.course' => function($query) {
                $query->select('id', 'title'); 
            }])
            ->select('students.id', 'students.name', 'students.email', 'students.birthdate')
            ->findOrFail($id);
            
            return json_response($response);
        } catch (ModelNotFoundException $e) {
            return json_response(['Error' => 'Id Not Found'], 404);
        } catch (Exception $e) {
            return json_response(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request, $vars): JsonResponse
    {
        StudentRequest::validate($request);

        $student = [
            'name' => $request->input('name'),
            'birthdate' => $request->input('birthdate'),
            'email' => $request->input('email')
        ];

        try {
            Student::create($student);
            return json_response(['Message' => 'Item registered successfully']);
        } catch (Exception $e) {

            return json_response(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $vars): JsonResponse
    {
        $id = (int) $vars['id'];
        $request['id'] = $id;
        StudentRequest::validate($request);

        $student = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'birthdate' => $request->input('birthdate'),
        ];

        try {
            $response = Student::findOrFail($id);
            $response->update($student);

            return json_response(['Message' => 'Item updated successfully'], 200);
        } catch (Exception $e) {
            return json_response(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $_request, $vars): JsonResponse
    {
        $id = (int) $vars['id'];
        try {
            $response = Student::findOrFail($id);
            $response->delete();
            return json_response(['Message' => 'Item removed successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return json_response(['Message' => 'Id Not Found'], 404);
        } catch (Exception $e) {
            return json_response(['Message' => 'Failed to remove item', 'Details' => $e->getMessage()], 500);
        }
    }
}
