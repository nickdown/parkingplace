<?php

namespace App\Rates;

class ThreeHourRate extends Rate implements RateInterface
{
    protected $ticket;
    
    function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function description()
    {
        return "Three Hour Rate";
    }

    public function isApplicable()
    {
        $duration = $this->duration();

        // between 61 minutes (1 hour plus 1 minute) and 180 minutes (3 hours)
        return (61 <= $duration) && ($duration <= 180); 
    }

    public function amount()
    {
        return 450;
    }
}
