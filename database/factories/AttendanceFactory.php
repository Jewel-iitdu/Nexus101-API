<?php

use Faker\Generator as Faker;

$factory->define(App\Attendance::class, function (Faker $faker) {
    return [
//        'attendance_id' => $faker->unique()->id,
        'course_code' => $faker->unique()->text($maxNbChars = 10),
        'date' => $faker->date,

    ];
});
