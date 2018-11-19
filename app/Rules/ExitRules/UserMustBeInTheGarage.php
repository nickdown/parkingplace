<?php

namespace App\Rules\ExitRules;

use Illuminate\Database\Eloquent\Model;
use App\Rules\ExitRules\ExitRuleInterface;

class UserMustBeInTheGarage extends Model implements ExitRuleInterface
{
    protected $user;

    function __construct($user)
    {
        $this->user = $user;
    }

    public function failureDescription()
    {
        return "The user is not in the garage.";
    }

    public function confirm()
    {
        return $this->user->isInGarage();
    }
}
