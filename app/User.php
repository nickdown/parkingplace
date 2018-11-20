<?php

namespace App;

use Exception;
use App\Garage;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function getCurrentTicketAttribute()
    {
        return $this->tickets()->orderBy('entered_at', 'desc')->where('exited_at', null)->first();
    }
}
