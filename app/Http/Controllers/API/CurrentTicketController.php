<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;

class CurrentTicketController extends Controller
{
    public function show()
    {
        $ticket = auth()->user()->currentTicket;

        if (null == $ticket) {
            abort(404, 'No current ticket.');
        }

        return new TicketResource($ticket);
    }
}
