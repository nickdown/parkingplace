<?php

namespace App;

use Exception;
use App\Garage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function garage()
    {
        return new Garage($this);
    }

    public function visits()
    {
        return $this->hasMany('App\Visit');
    }
    
    public function exitGarage()
    {
        if (! $this->isInGarage()) {
            throw new Exception('User not in garage');
        }

        $visit = $this->currentVisit;
        $visit->ending_at = now();
        $visit->save();


        return $visit;
    }

    public function isInGarage()
    {
        if ($this->visits()->count() == 0) {
            return false;
        }

        $latestVisit = $this->visits()->orderBy('starting_at', 'desc')->first();

        return $latestVisit->ending_at == null;
    }

    public function canEnterGarage()
    {
        if ($this->isInGarage()) {
            return false;
        }
        return true;
    }

    public function getCurrentVisitAttribute()
    {
        return $this->visits()->orderBy('starting_at', 'desc')->where('ending_at', null)->first();
    }
}
