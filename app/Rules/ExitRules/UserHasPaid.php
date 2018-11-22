<?php

namespace App\Rules\ExitRules;

use App\Rules\RuleInterface;
use Illuminate\Database\Eloquent\Model;

class UserHasPaid extends Model implements RuleInterface
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
        return $this->user->currentTicket->isPaid();
    }
}
