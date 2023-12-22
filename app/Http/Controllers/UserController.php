<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Resources\UserResource;
use App\Services\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register(RegisterRequest $request): UserResource
    {
        return new UserResource($this->userService->register($request));
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): String
    {
        return $this->userService->login($request);
    }

    public function logout(): JsonResponse
    {
        $this->userService->logout();
        return response()->json(['Status' => 'Logged Out']);
    }
}
