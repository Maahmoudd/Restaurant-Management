<?php

namespace App\Services\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\Contracts\UserContract;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService implements UserContract
{

    public function register(RegisterRequest $request): User
    {
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->validated());
        return $user;

    }

    public function login(LoginRequest $request): String
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $user->createToken('remember_token')->plainTextToken;
        }

        throw ValidationException::withMessages([
            'email' => ['Invalid credentials'],
        ]);
    }

    public function logout()
    {
       auth()->user()->currentAccessToken()->delete();
    }
}
