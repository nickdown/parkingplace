<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function store(Request $request)
    {
        info($request->all());

        Stripe::setApiKey(config('services.stripe.secret'));

        $customer = Customer::create([
            'email' => $request->stripeEmail,
            'source' => $request->stripeToken
        ]);

        Charge::create([
            'customer' => $customer->id,
            'amount' => 100,
            'currency' => 'cad',
        ]);

        info('payment succeeded');

        return 'Successfully charged card';
    }
}
