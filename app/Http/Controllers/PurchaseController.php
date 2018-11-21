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
        Stripe::setApiKey(config('services.stripe.secret'));

        $ticket = auth()->user()->currentTicket;
        $amount = $ticket->rate()->amount();

        $customer = Customer::create([
            'email' => $request->stripeEmail,
            'source' => $request->stripeToken
        ]);

        Charge::create([
            'customer' => $customer->id,
            'amount' => $amount,
            'currency' => 'cad',
        ]);

        $ticket->paid_at = now();
        $ticket->paid_amount = $amount;
        $ticket->save();

        return 'Successfully charged card';
    }
}
