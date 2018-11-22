<?php

namespace App\Rules\EntryRules;

use App\Rules\RuleInterface;
use Illuminate\Database\Eloquent\Model;

class UserNotInGarage extends Model implements RuleInterface
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
