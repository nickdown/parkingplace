<?php

namespace App\Http\Controllers;

use Exception;
use App\ExitValidator;
use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;

class ExitController extends Controller
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
            ExitValidator::confirm($user);
        } catch (Exception $e) {
            return response($e->getMessage(), 403);
        }

        $ticket = $user->garage()->exit();

        return new TicketResource($ticket);
    }
}
