<?php

namespace App;

use Exception;
use App\Rules\ExitRules\UserHasPaid;
use App\Rules\ExitRules\UserInGarage;
use Illuminate\Database\Eloquent\Model;

class ExitValidator extends Model
{
    protected $exitRules = [
       UserInGarage::class,
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
