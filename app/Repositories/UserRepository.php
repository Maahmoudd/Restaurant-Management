<?php

namespace App\Repositories;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

class UserRepository
{

    public function register(RegisterRequest $request)
    {
        return User::create($request->validated());
    }

    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
