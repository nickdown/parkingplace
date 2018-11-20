<?php

namespace App\Rates;

interface RateInterface {
    function __construct($visit);
    
    public function description();

    public function isApplicable();

    public function amount();
}
