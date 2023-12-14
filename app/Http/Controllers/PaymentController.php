<?php

namespace App\Http\Controllers;

use App\Services\Facades\PaymentFacade;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        return PaymentFacade::process($request);
    }

    public function show(Request $request, $id)
    {
        return PaymentFacade::show($request, $id);
    }
}
