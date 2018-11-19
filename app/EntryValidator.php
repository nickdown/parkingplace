<?php

namespace App;

use Exception;
use App\Rules\EntryRules\GarageHasRoom;
use Illuminate\Database\Eloquent\Model;
use App\Rules\EntryRules\UserNotInGarage;

class EntryValidator extends Model
{
    public static function confirm($user)
    {
        $entryRules = [
            GarageHasRoom::class,        
            UserNotInGarage::class,
        ];

        foreach ($entryRules as $rule)
        {
            $rule = new $rule($user);
            
            if (! $rule->confirm()) {
                throw new Exception($rule->failureDescription());
            }
        }

        return true;
    }
}
