<?php

namespace App\Listeners;

use App\Events\GateRaiseRequested;

class RaiseGate
{
    /**
     * Handle the event.
     *
     * @param  GateRaiseRequested  $event
     * @return void
     */
    public function handle(GateRaiseRequested $event)
    {
        // this is where the real life gate-raising api would be called from
        info('Gate was raised.');
    }
}
