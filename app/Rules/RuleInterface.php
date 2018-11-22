<?php

namespace App\Rules;

interface RuleInterface {
    function __construct($user);
    
    public function failureDescription();

    public function confirm();
}
