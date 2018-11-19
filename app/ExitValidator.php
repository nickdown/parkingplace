<?php

namespace App;

use Exception;
use App\Rules\ExitRules\UserHasPaid;
use Illuminate\Database\Eloquent\Model;
use App\Rules\ExitRules\UserMustBeInTheGarage;

class ExitValidator extends Model
{
    protected $exitRules = [
       UserMustBeInTheGarage::class,
       UserHasPaid::class,
    ];

    public function confirm($user)
    {
        foreach ($this->exitRules as $rule)
        {
            $rule = new $rule($user);
            
            if (! $rule->confirm()) {
                throw new Exception($rule->failureDescription());
            }
        }

        return true;
    }
}
