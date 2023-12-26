<?php

namespace App\Services\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Contracts\UserContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService implements UserContract
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request): User
    {
        $request['password'] = Hash::make($request['password']);
        $user = $this->userRepository->register($request);
        return $user;
    }

    public function login(LoginRequest $request): String
    {
        $credentials = $request->validated();
        $user = $this->userRepository->getUserByEmail($credentials['email']);
        if ($user && Auth::attempt($credentials)) {
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
