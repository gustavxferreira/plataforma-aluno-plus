<?php

namespace App\Controllers;

use App\Enums\EnrollmentStatus;
use App\Models\Enrollment;
use App\Request\EnrollmentRequest;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class EnrollmentsController
{
    public function index(Request $request, $vars): JsonResponse
    {
        try {
            $response = Enrollment::leftJoin('courses', 'enrollments.course_id', '=', 'courses.id')
                ->leftJoin('students', 'enrollments.student_id', '=', 'students.id')
                ->select(
                    'enrollments.id',
                    'name',
                    'course_id',
                    'email',
                    'enrollment_code',
                    'enrollment_date',
                    'status',
                    'title',
                    'duration',
                    'date_archived',
                )
                ->get();

            return json_response($response);
        } catch (Exception $e) {
            return json_response(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        }
    }

    public function show(Request $request, $vars): JsonResponse
    {
        $id = $vars['id'];
        try {
            $response = Enrollment::with([
                'student:id,name,birthdate,email',  
                'course:id,title,duration,date_archived'  
            ])->select('id', 'enrollment_code', 'enrollment_date', 'status', 'student_id', 'course_id')  
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
        try {
            EnrollmentRequest::validate($request);
            $enrollment = [
                "student_id" => $request->input('student_id'),
                "course_id" => $request->input('course_id'),
                "enrollment_code" => Str::random(10),
                "enrollment_date" => $request->input('enrollment_date'),
                "status" => $request->input('status'),
            ];
            Enrollment::create($enrollment);
            return json_response(['Message' => 'Item registered successfully']);
        } catch (Exception $e) {
            return json_response(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $vars): JsonResponse
    {
        $id = $vars['id'];

        $statusInput = $request->status;
        $status = EnrollmentStatus::tryFrom($statusInput);
        try {
            v::date()->assert($request->enrollment_date);
            v::notEmpty()->assert($request->enrollment_date);
            v::date()->between('2020-01-01', '2030-01-01')->assert($request->enrollment_date);
            v::in([EnrollmentStatus::ACTIVE, EnrollmentStatus::INACTIVE, EnrollmentStatus::SUSPENDED])->assert($status);
            
            $response = Enrollment::findOrFail($id);

            $response->enrollment_date = $request->enrollment_date;
            $response->status = $request->status;
            $response->save();
            return json_response(['Message' => 'Item updated successfully'], 200);
        } catch (Exception $e) {
            return json_response(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        } catch (NestedValidationException $e) {
            return json_response(['Error' => 'Insert valid Fields.', 'Message' => $e->getMessages()], 400);
        }
    }

    public function destroy(Request $_request, $vars): JsonResponse
    {
        $id = (int) $vars['id'];
        try {
            $response = Enrollment::findOrFail($id);
            $response->delete();
            return json_response(['Message' => 'Item removed successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return json_response(['Message' => 'Id Not Found'], 404);
        } catch (Exception $e) {
            return json_response(['Message' => 'Failed to remove item', 'Details' => $e->getMessage()], 500);
        }
    }

}
