<?php

namespace App\Rates;

class SixHourRate extends Rate implements RateInterface
{
    protected $ticket;
    
    function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function description()
    {
        return "Six Hour Rate";
    }

    public function isApplicable()
    {
        $duration = $this->duration();

        // between 181 minutes (3 hours plus 1 minute) and 360 minutes (6 hours)
        return (181 <= $duration) && ($duration <= 360); 
    }

    public function amount()
    {
        return 675;
    }
}
