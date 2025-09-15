<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        return view('payment.success'); 
    }

    public function failure(Request $request)
    {
        return view('payment.failure'); 
    }
}
