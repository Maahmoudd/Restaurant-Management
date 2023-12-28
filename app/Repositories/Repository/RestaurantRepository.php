<?php

namespace App\Repositories\Repository;

use App\Models\Restaurant;
use App\Repositories\Interfaces\RestaurantRepositoryInterface;

class RestaurantRepository implements RestaurantRepositoryInterface
{

    public function findById(int $id)
    {
        return Restaurant::findOrFail($id);
    }
}
