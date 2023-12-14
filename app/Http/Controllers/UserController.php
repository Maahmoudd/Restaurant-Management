<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\Facades\UserFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = UserFacade::register($request->only([
            'email',
            'password',
            'name'
        ]));
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        return UserFacade::login($request);
    }

    public function logout(Request $request): JsonResponse
    {
        return UserFacade::logout($request);
    }
}
