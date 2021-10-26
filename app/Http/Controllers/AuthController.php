<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('username', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['access' => $token]);
        }
        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout(): JsonResponse
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Logged out Successfully.']);
    }

    public function refresh(): JsonResponse
    {
        if ($token = $this->guard()->refresh()) {
            return response()->json(['access' => $token]);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
