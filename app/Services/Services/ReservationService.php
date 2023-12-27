<?php

namespace App\Services\Services;

use App\Exceptions\RestaurantExceptions\FullRestaurantException;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Repositories\Interfaces\ReservationRepositoryInterface;
use App\Repositories\Interfaces\RestaurantRepositoryInterface;
use App\Services\Contracts\ReservationContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationService implements ReservationContract
{
    protected $restaurantRepository;
    protected $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository, RestaurantRepositoryInterface $restaurantRepository)
    {
        $this->reservationRepository = $reservationRepository;
        $this->restaurantRepository = $restaurantRepository;
    }

    public function create(ReservationRequest $request): Reservation
    {
        $validatedData = $request->validated();
        $userId = $request->user()->id;

        $reservationData = array_merge($validatedData, [
            'user_id' => $userId,
            'status' => Reservation::STATUS_PENDING,
        ]);

        $restaurant = $this->restaurantRepository->findById($reservationData['restaurant_id']);

        $reservation = DB::transaction(function () use ($reservationData, $restaurant) {
            if ($restaurant->tables_count === 0) {
                throw new FullRestaurantException('The restaurant is full.');
            }

            $reservation = $this->reservationRepository->create($reservationData);

            $restaurant->decrement('tables_count');

            return $reservation;
        });

        return $reservation;
    }
    public function update(UpdateReservationRequest $request, $id): Reservation | null
    {
        $validatedReservationUpdate = $request->validated();
        $reservation = $this->reservationRepository->findById($id);
        if ($reservation->user_id != $request->user()->id)
        {
            return null;
        }
        $reservation->update($validatedReservationUpdate);
        return $reservation;
    }

    public function show(Request $request, $id): Reservation
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id !== $request->user()->id) {
            return false;
        }

        return $reservation;
    }

    public function cancel(Request $request, $id):bool
    {
        $reservation = $this->reservationRepository->findById($id);

        if ($reservation->user_id !== $request->user()->id) {
            return false;
        }

        $restaurant = $this->restaurantRepository->findById($reservation->restaurant_id);
        $restaurant['tables_count'] = $restaurant['tables_count'] + 1;
        $restaurant->save();

        return $reservation->delete();
    }
    public function index(Request $request): Collection
    {
        $userId = $request->user()->id;
        $reservations = $this->reservationRepository->getAllUserReservations($userId);

        return $reservations;
    }
}
