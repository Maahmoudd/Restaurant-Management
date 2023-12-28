<?php

namespace App\Repositories\Repository;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
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
