<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        'email' =>$faker->unique()->safeEmail,
        'blood_group' => $faker->regexify('^(A|B|AB|O)[-+]$'),
        'address' => $faker->address,
        'date_of_birth' => $faker->date,
        'registration_number' => $faker->text($maxNbChars = 20),
        'roll_number' => $faker->text($maxNbChars = 20),
        'session' => $faker->text($maxNbChars = 20),
        'attached_hall' => $faker->text($maxNbChars = 20),
        'semester/year' => $faker->numberBetween($min = 1, $max = 8),
        'active' => $faker->numberBetween($min = 1, $max = 8),

    ];
});
