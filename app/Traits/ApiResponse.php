<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function success($data, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ], $statusCode);
    }

    public function error($data, int $statusCode = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' => $data,
        ], $statusCode);
    }
}
