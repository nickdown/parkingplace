<?php

namespace App\Http\Controllers\API;

use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;

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

        return new TicketResource($ticket);
    }
}
