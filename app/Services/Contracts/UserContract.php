<?php

namespace App\Services\Contracts;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

interface UserContract
{
    public function register(RegisterRequest $request): User;

    public function login(LoginRequest $request): String;

    public function logout();
}
