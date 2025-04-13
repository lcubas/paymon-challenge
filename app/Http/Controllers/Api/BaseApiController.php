<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;

abstract class BaseApiController extends Controller
{
    use ApiResponseTrait;

    protected function respondWithCollection($data, $message = null)
    {
        return $this->successResponse($data, $message);
    }

    protected function respondWithItem($data, $message = null)
    {
        return $this->successResponse($data, $message);
    }

    protected function respondWithMessage($message)
    {
        return $this->successResponse(null, $message);
    }
}
