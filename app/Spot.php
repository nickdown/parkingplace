<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $garage;

    function __construct($garage = null)
    {
        $this->garage = $garage;
    }

    public function total()
    {
        return (int) config('garage.spots');
    }

    public function used()
    {
        return Visit::where('ending_at', null)->count();
    }

    public function available()
    {
        $available = $this->total() - $this->used();

        return max(0, $available);
    }
}
