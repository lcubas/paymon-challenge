<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{
    protected function respondWithPagination($data, $message = null)
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data->items(),
            'meta' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total()
            ]
        ]);
    }
    
    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
        ], $code);
    }
}
