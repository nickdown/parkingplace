<?php

namespace App\Rates;

interface RateInterface {
    function __construct($ticket);
    
    public function description();

    public function isApplicable();

    public function amount();
}
