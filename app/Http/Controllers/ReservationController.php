<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Resources\ReservationResource;
use App\Services\Facades\ReservationFacade;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create(ReservationRequest $request)
    {
        return new ReservationResource(ReservationFacade::create($request));
    }

    public function update(UpdateReservationRequest $request, $id)
    {
        return new ReservationResource(ReservationFacade::update($request, $id)) ??
            response()->json(['status' => 'Not Authorized']);
    }

    public function show(Request $request, $id)
    {
        return new ReservationResource(ReservationFacade::show($request, $id)) ??
            response()->json(['status' => 'Not Authorized']);
    }

    public function cancel(Request $request, $id)
    {
        if(ReservationFacade::cancel($request, $id));
        {
            return response()->json(['status' => 'canceled']);
        }
    }
    public function index(Request $request)
    {
        return ReservationResource::collection(ReservationFacade::index($request));
    }
}
