<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentStripeController extends Controller
{

    public function index(){
        return view('probandopago');
    }

    public function paymentProcess(Request $request){

        // return redirect(route(''));
    }
}
