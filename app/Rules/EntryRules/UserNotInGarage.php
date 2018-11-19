<?php

namespace App\Rules\EntryRules;

use Illuminate\Database\Eloquent\Model;
use App\Rules\EntryRules\EntryRuleInterface;

class UserNotInGarage extends Model implements EntryRuleInterface
{
    protected $user;

    function __construct($user)
    {
        $this->user = $user;
    }

    public function failureDescription()
    {
        return "The user is already in the garage.";
    }

    public function confirm()
    {
        return ! $this->user->garage()->inside();
    }
}
