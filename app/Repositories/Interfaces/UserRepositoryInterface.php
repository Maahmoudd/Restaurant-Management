<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

interface UserRepositoryInterface
{

    public function register(RegisterRequest $request);

    public function getUserByEmail(string $email);

}
