<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result, $message): JsonResponse
    {
        $response = [
            'status' => 'success',
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }
    public function sendResponseWithoutData($message): JsonResponse
    {
        $response = [
            'status' => 'success',
            'message' => $message,
        ];

        return response()->json($response, 200);
    }
    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse
    {
        $response = [
            'status' => 'error',
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function unauthenticated(): JsonResponse
    {
        return response()->json(['message' => 'Unauthenticated.'], 401);

    }
}
