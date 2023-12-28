<?php

namespace App\Repositories\Repository;

use App\Models\Reservation;
use App\Repositories\Interfaces\ReservationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ReservationRepository implements ReservationRepositoryInterface
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
