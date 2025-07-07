<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public function sendSuccess($data = [], $message = 'Operation successful', $code = 200): JsonResponse
    {
        return response()->json(['status' => true, 'message' => $message, 'data' => $data], $code);
    }

    public function sendError($data = [], $message = 'Operation failed', $code = 400): JsonResponse
    {
        return response()->json(['status' => false, 'message' => $message, 'data' => $data], $code);
    }
}
