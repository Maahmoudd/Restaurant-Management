<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface UserContract
{
    public function register(Request $request): User;

    public function login(Request $request): JsonResponse;

    public function logout(Request $request): JsonResponse;
}
