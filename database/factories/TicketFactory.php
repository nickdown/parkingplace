<?php

use Faker\Generator as Faker;

$factory->define(App\Ticket::class, function (Faker $faker) {
    $enteredAt = $faker->unixTime();
    
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'entered_at' => $enteredAt,
        
        //exit within 9 hours
        'exited_at' => $enteredAt + random_int(1, 9*60*60),
    ];
});
