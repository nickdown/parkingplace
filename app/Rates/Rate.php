<?php

namespace App\Rates;

abstract class Rate
{
    public function duration()
    {
        $starting_at = $this->ticket->starting_at;
        $ending_at = $this->ticket->ending_at ?? now();

        return $starting_at->diffInMinutes($ending_at);
    }
}
