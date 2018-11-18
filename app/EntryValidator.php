<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use App\Rules\EntryRules\UserNotInGarage;

class EntryValidator extends Model
{
    protected $entryRules = [
        UserNotInGarage::class,
    ];

    public function confirm($user)
    {
        foreach ($this->entryRules as $rule)
        {
            if (! (new $rule)->confirm($user)) {
                throw new Exception($rule->failureDescription());
            }
        }

        return true;
    }
}
