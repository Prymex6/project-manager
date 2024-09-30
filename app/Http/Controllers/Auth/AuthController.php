<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\LoginService;
use App\Services\RegisterService;

class AuthController extends Controller
{
    private RegisterService $registerService;
    private LoginService $loginService;

    public function __construct(RegisterService $Registerservice, LoginService $LoginService)
    {
        $this->registerService = $Registerservice;
        $this->loginService = $LoginService;
    }

    public function register(RegisterRequest $request)
    {
        $this->registerService->store($request);

        return response()->json('Registration has been successful!', 201);
    }

    public function login(LoginRequest $request)
    {
        $user = $this->loginService->login($request);

        if (!$user) {
            return response()->json(['message' => 'Login failed.'], 401);
        }

        return response()->json(['message' => 'Login successful.', 'user_token' => $user->createToken('user_token')->plainTextToken], 401);
    }
}
