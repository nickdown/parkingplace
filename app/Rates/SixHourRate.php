<?php

namespace App\Rates;

class SixHourRate extends Rate implements RateInterface
{
    protected $visit;
    
    function __construct($visit)
    {
        $this->visit = $visit;
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
