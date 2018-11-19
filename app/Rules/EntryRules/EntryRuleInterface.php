<?php

namespace App\Rules\EntryRules;

interface EntryRuleInterface {
    function __construct($user);
    
    public function failureDescription();

    public function confirm();
}