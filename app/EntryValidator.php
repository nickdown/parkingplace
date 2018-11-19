<?php

namespace App;

use Exception;
use App\Rules\EntryRules\GarageHasRoom;
use Illuminate\Database\Eloquent\Model;
use App\Rules\EntryRules\UserNotInGarage;

class EntryValidator extends Model
{
    protected $entryRules = [
        GarageHasRoom::class,        
        UserNotInGarage::class,
    ];

    public function confirm($user)
    {
        foreach ($this->entryRules as $rule)
        {
            $rule = new $rule($user);
            
            if (! $rule->confirm()) {
                throw new Exception($rule->failureDescription());
            }
        }

        return true;
    }
}
