<?php

namespace App\Rules\EntryRules;

interface EntryRuleInterface {
    public function failureDescription();

    public function confirm($user);
}