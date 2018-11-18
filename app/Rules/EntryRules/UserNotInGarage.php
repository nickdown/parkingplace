<?php

namespace App\Rules\EntryRules;

use Illuminate\Database\Eloquent\Model;
use App\Rules\EntryRules\EntryRuleInterface;

class UserNotInGarage extends Model implements EntryRuleInterface
{
    public function failureDescription()
    {
        return "The user is in the garage";
    }

    public function confirm($user)
    {
        return ! $user->isInGarage();
    }
}