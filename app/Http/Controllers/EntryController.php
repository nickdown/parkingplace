<?php

namespace App\Http\Controllers;

use Exception;
use App\Visit;
use App\EntryValidator;
use Illuminate\Http\Request;

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

            $user->enterGarage();

            return redirect('home');
        } catch (Exception $e) {
            return response('home', 403);
        }
    }
}
