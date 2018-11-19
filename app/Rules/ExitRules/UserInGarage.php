<?php

namespace App\Rules\ExitRules;

use Illuminate\Database\Eloquent\Model;
use App\Rules\ExitRules\ExitRuleInterface;

class UserInGarage extends Model implements ExitRuleInterface
{
    protected $user;

    function __construct($user)
    {
        $this->user = $user;
    }

    public function failureDescription()
    {
        return "The user is in the garage";
    }

    public function confirm()
    {
        return $this->user->isInGarage();
    }
}
