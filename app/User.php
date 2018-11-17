<?php

namespace App;

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

    public function visits()
    {
        return $this->hasMany('App\Visit');
    }

    public function enterGarage()
    {
        if (! $this->canEnterGarage()) {
            throw new \Exception('User cannot enter the garage');
        }

        $visit = $this->visits()->create([
            'starting_at' => now()
        ]);

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
}
