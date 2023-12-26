<?php

namespace App\Repositories;

use App\Http\Requests\RegisterRequest;
use App\Models\Restaurant;
use App\Models\User;

class RestaurantRepository
{

    public function findById(int $id)
    {
        return Restaurant::findOrFail($id);
    }
}
