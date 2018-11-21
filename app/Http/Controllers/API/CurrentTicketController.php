<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;

class CurrentTicketController extends Controller
{
    public function show()
    {
        $ticket = optional(auth()->user())->currentTicket;

        return new TicketResource($ticket);
    }
}
