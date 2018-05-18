<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'course_name' => $faker->unique()->text($maxNbChars = 20),
        'course_code' => $faker->unique()->text($maxNbChars =6),

    ];
});
