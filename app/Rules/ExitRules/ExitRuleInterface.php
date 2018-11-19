<?php

namespace App\Rules\ExitRules;

interface ExitRuleInterface {
    function __construct($user);
    
    public function failureDescription();

    public function confirm();
}
