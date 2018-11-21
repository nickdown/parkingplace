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
        'entered_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'entered_at',
        'exited_at',
        'paid_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function rate()
    {
        return RateCalculator::determine($this);
    }

    public function isPaid()
    {
        return $this->paid_at != null;
    }
}
