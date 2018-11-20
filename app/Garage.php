<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    protected $user;

    function __construct($user = null)
    {
        $this->user = $user;
    }

    public function spots()
    {
        return new Spot($this);
    }

    public function full()
    {
        return 0 == $this->spots()->available();
    }

    public function enter()
    {
        $ticket = $this->user->tickets()->create([
            'starting_at' => now()
        ]);

        return $ticket;
    }

    public function exit()
    {
        if (! $this->inside()) {
            throw new Exception('User not in garage');
        }

        $ticket = $this->user->currentTicket;
        $ticket->ending_at = now();
        $ticket->save();


        return $ticket;
    }

    public function inside()
    {
        return $this->user->currentTicket != null;
    }
}
