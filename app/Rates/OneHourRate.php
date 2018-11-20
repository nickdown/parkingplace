<?php

namespace App\Rates;

class OneHourRate extends Rate implements RateInterface
{
    protected $visit;
    
    function __construct($visit)
    {
        $this->visit = $visit;
    }

    public function description()
    {
        return "One Hour Rate";
    }

    public function isApplicable()
    {
        $duration = $this->duration();
        
        // between 0 minutes and 60 minutes (1 hour)
        return (0 <= $duration) && ($duration <= 60); 
    }

    public function amount()
    {
        return 300;
    }
}
