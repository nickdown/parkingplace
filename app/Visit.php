<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'starting_at',
        'ending_at'
    ];
}
