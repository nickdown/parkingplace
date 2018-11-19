<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    protected $user;

    function __construct($user = null)
    {
        $this->user = $user;
    }

    public function spots()
    {
        return new Spot($this);
    }

    public function full()
    {
        return 0 == $this->spots()->available();
    }

    public function enter()
    {
        if (! $this->user->canEnterGarage()) {
            throw new Exception('User cannot enter the garage');
        }

        $visit = $this->user->visits()->create([
            'starting_at' => now()
        ]);

        return $visit;
    }
}
