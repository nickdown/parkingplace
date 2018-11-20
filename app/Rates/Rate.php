<?php

namespace App\Rates;

abstract class Rate
{
    public function duration()
    {
        $starting_at = $this->visit->starting_at;
        $ending_at = $this->visit->ending_at ?? now();

        return $starting_at->diffInMinutes($ending_at);
    }
}
