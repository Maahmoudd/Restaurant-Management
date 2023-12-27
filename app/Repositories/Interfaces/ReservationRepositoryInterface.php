<?php

namespace App\Repositories\Interfaces;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;

interface ReservationRepositoryInterface
{

    public function create(array $reservationData);

    public function findById(int $id);

    public function getAllUserReservations(int $userId): Collection;
}
