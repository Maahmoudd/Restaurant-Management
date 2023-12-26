<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Resources\UserResource;
use App\Services\Facades\UserFacade;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function register(RegisterRequest $request): UserResource
    {
        return new UserResource(UserFacade::register($request));
    }

    public function login(LoginRequest $request): String
    {
        return UserFacade::login($request);
    }

    public function logout(): JsonResponse
    {
        UserFacade::logout();
        return response()->json(['Status' => 'Logged Out']);
    }
}
