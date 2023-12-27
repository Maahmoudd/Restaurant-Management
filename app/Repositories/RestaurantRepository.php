<?php

namespace App\Repositories;

use App\Http\Requests\RegisterRequest;
use App\Models\Restaurant;
use App\Models\User;
use App\Repositories\Interfaces\RestaurantRepositoryInterface;

class RestaurantRepository implements RestaurantRepositoryInterface
{

    public function findById(int $id)
    {
        return Restaurant::findOrFail($id);
    }
}
