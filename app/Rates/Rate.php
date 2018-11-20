<?php

namespace App\Rates;

abstract class Rate
{
    public function duration()
    {
        $entered_at = $this->ticket->entered_at;
        $exited_at = $this->ticket->exited_at ?? now();

        return $entered_at->diffInMinutes($exited_at);
    }
}
