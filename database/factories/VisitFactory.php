<?php

use Faker\Generator as Faker;

$factory->define(App\Visit::class, function (Faker $faker) {
    $startingAt = $faker->unixTime();
    
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'starting_at' => $startingAt,
        
        //end within 9 hours
        'ending_at' => $startingAt + random_int(1, 9*60*60),
    ];
});
