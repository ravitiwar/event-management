<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\AuthService;
use App\Services\Auth\Credentials;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $registerRequest)
    {
        return response()->success($this->authService->register($registerRequest), "Registration successfull");
    }

    public function login(LoginRequest $loginRequest)
    {
        return response()->success($this->authService->login(new Credentials($loginRequest->get('email'),$loginRequest->get('password'))));
    }
}
