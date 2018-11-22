<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Ticket;
use App\EntryValidator;
use Illuminate\Http\Request;
use App\Events\GateRaiseRequested;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;

class EntryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        try {
            $entryValidator = EntryValidator::confirm($user);
            $ticket = $user->garage()->enter();
            
            event(new GateRaiseRequested());

            return new TicketResource($ticket);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
}
