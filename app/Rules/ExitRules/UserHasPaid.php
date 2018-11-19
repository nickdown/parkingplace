<?php

namespace App\Rules\ExitRules;

use Illuminate\Database\Eloquent\Model;
use App\Rules\ExitRules\ExitRuleInterface;

class UserHasPaid extends Model implements ExitRuleInterface
{
    protected $user;

    function __construct($user)
    {
        $this->user = $user;
    }

    public function failureDescription()
    {
        return "The user has not paid.";
    }

    public function confirm()
    {
        // exiting the garage is free for now
        return true;
    }
}
