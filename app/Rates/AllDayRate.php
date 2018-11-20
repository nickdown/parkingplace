<?php

namespace App\Rates;

class AllDayRate extends Rate implements RateInterface
{
    protected $visit;

    function __construct($visit)
    {
        $this->visit = $visit;
    }

    public function description()
    {
        return "All Day Rate";
    }

    public function isApplicable()
    {
        $duration = $this->duration();

        // greater than or equal to 361 minutes (6 hours plus 1 minute)
        return 361 <= $duration; 
    }

    public function amount()
    {
        return 1013;
    }
}
