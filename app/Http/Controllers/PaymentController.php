<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Resources\PaymentResource;
use App\Services\Facades\PaymentFacade;

class PaymentController extends Controller
{
    public function process(PaymentRequest $request)
    {
        return new PaymentResource(PaymentFacade::process($request));
    }

    public function show($id)
    {
        return new PaymentResource(PaymentFacade::show($id));
    }
}
