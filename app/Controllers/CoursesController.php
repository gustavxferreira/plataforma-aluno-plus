<?php

namespace App\Controllers;

use App\Models\Courses;
use App\Request\CourseRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoursesController
{
    public function index(): JsonResponse
    {
        try {
            $response = Courses::orderBy('date_archived', 'asc')->get();
            return json_response($response);
        } catch (Exception $e) {
            return json_response(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        }
    }

    public function show(Request $_request, $vars): JsonResponse
    {
        $id = (int) $vars['id'];
        try {
            $response = Courses::findOrFail($id);
            return json_response($response);
        } catch (ModelNotFoundException $e) {
            return json_response(['Error' => 'Id Not Found'], 404);
        } catch (Exception $e) {
            return json_response(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request, $vars): JsonResponse
    {
        CourseRequest::validate($request);

        try {
            Courses::create($request->all());
            return json_response(['Message' => 'Item registered successfully']);
        } catch (Exception $e) {
            return json_response(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $vars): JsonResponse
    {
        $id = (int) $vars['id'];

        try {
            $response = Courses::findOrFail($id);

            if ($request['date_archived_status'] === 'on' && $response->date_archived === null) {
                $response->date_archived = Carbon::today()->toDateString();
            }
            if (!$request['date_archived_status']) {
                $response->date_archived = null;
            }
            CourseRequest::validate($request);
            $response->update($request->all());

            return json_response(['Message' => 'Item updated successfully'], 200);
        } catch (Exception $e) {
            return json_response(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        }
    }

}
