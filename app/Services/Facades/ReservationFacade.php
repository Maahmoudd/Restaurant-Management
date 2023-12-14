<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class ReservationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ReservationService';
    }
}
