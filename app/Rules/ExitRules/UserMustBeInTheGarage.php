<?php

namespace App\Rules\ExitRules;

use App\Rules\RuleInterface;
use Illuminate\Database\Eloquent\Model;

class UserMustBeInTheGarage extends Model implements RuleInterface
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
        return $this->user->garage()->inside();
    }
}
