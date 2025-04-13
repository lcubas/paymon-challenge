<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseApiController
{
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return $this->errorResponse('Invalid credentials', 401);
            }

            $token = $user->createToken('api-token')->plainTextToken;

            return $this->successResponse([
                'token' => $token,
                'user' => $user
            ], 'Login successful');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function logout()
    {
        try {
            User::find(Auth::id())->currentAccessToken()->delete();
            return $this->respondWithMessage('Logged out successfully');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
