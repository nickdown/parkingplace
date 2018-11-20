<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'starting_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'starting_at',
        'ending_at',
        'paid_at'
    ];

    public function isPaid()
    {
        return $this->paid_at != null;
    }
}
