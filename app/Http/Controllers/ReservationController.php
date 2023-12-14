<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Services\Facades\ReservationFacade;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create(Request $request)
    {
        return ReservationFacade::create($request);
    }

    public function update(Request $request, $id)
    {
        return ReservationFacade::update($request, $id);
    }

    public function show(Request $request, $id)
    {
        return ReservationFacade::show($request, $id);
    }

    public function cancel(Request $request, $id)
    {
        return ReservationFacade::cancel($request, $id);
    }
    public function index(Request $request)
    {
        return ReservationFacade::index($request);
    }
}
