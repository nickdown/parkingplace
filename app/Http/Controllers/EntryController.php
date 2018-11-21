<?php

namespace App\Http\Controllers;

use Exception;
use App\Ticket;
use App\EntryValidator;
use Illuminate\Http\Request;
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

            return new TicketResource($ticket);
        } catch (Exception $e) {
            
            return response($e->getMessage(), 403);
        }
    }
}
