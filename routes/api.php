<?php

use App\Http\Controllers\Api\AcademyController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\CommunicationController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('academies', AcademyController::class)->only(['index', 'store']);
    Route::apiResource('courses', CourseController::class)->only(['index', 'show']);
    Route::apiResource('enrollments', EnrollmentController::class)->only(['store']);
    Route::apiResource('payments', PaymentController::class)->only(['store']);
    Route::apiResource('communications', CommunicationController::class)->only(['store']);

    Route::post('communications/{communication}/send', [CommunicationController::class, 'send']);
});
