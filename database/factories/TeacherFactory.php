<?php

use Faker\Generator as Faker;

$factory->define(App\Teacher::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'designation' => $faker->text($maxNbChars = 20),
        'blood' => $faker->regexify('^(A|B|AB|O)[-+]$'),
    ];
});
