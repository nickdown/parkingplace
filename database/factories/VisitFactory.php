<?php

use Faker\Generator as Faker;

$factory->define(App\Visit::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'starting_at' => $faker->dateTime('now'),
    ];
});
