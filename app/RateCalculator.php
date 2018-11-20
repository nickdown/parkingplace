<?php

namespace App;

use App\Rates\AllDayRate;
use App\Rates\OneHourRate;
use App\Rates\SixHourRate;
use App\Rates\ThreeHourRate;
use Illuminate\Database\Eloquent\Model;

class RateCalculator extends Model
{
    public static function determine($visit)
    {
        $rates = [
            OneHourRate::class,
            ThreeHourRate::class,
            SixHourRate::class,
            AllDayRate::class,        
        ];

        foreach ($rates as $rate)
        {
            $rate = new $rate($visit);
            
            //return the first applicable rate
            if ($rate->isApplicable()) {
                return $rate;
            }
        }
        
        throw new Exception('No applicable rate was found');
    }
}
