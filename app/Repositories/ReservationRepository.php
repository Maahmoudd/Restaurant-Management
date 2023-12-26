<?php

namespace App\Repositories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;

class ReservationRepository
{

    public function create(array $reservationData)
    {
        return Reservation::create($reservationData);
    }

    public function findById(int $id)
    {
        return Reservation::findOrFail($id);
    }

    public function getAllUserReservations(int $userId): Collection
    {
        return Reservation::where('user_id', $userId)->get();
    }
}
