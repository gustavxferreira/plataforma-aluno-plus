<?php

use Illuminate\Http\JsonResponse;

function json_response($data, $status = 200): JsonResponse
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}
