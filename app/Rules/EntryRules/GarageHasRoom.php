<?php

namespace App\Rules\EntryRules;

use App\Garage;
use Illuminate\Database\Eloquent\Model;
use App\Rules\EntryRules\EntryRuleInterface;

class GarageHasRoom extends Model implements EntryRuleInterface
{
    protected $user;

    function __construct($user = null)
    {
        $this->user = $user;
    }

    public function failureDescription()
    {
        return "There is no room for another car in the garage.";
    }

    public function confirm()
    {
        $garage = new Garage();

        return ! $garage->full();
    }
}
