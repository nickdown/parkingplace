<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    public function spots()
    {
        return new Spot($this);
    }

    public function full()
    {
        return 0 == $this->spots()->available();
    }
}
