<?php

namespace App;

use Exception;
use App\Rules\ExitRules\UserHasPaid;
use Illuminate\Database\Eloquent\Model;
use App\Rules\ExitRules\UserMustBeInTheGarage;

class ExitValidator extends Model
{
    public static function confirm($user)
    {
        $exitRules = [
            UserMustBeInTheGarage::class,
            UserHasPaid::class,
        ];

        foreach ($exitRules as $rule)
        {
            $rule = new $rule($user);
            
            if (! $rule->confirm()) {
                throw new Exception($rule->failureDescription());
            }
        }

        return true;
    }
}
