<?php

use Faker\Generator as Faker;

$factory->define(App\Group::class, function (Faker $faker) {
    return [
        'group_name' => $faker->unique()->text($maxNbChars = 20),
        'semester/year' =>$faker->unique()->numberBetween($min = 1, $max = 8),
    ];
});
