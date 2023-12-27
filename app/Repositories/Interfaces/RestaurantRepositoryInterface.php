<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\RegisterRequest;
use App\Models\Restaurant;
use App\Models\User;

interface RestaurantRepositoryInterface
{

    public function findById(int $id);

}
