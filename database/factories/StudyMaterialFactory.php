<?php

use Faker\Generator as Faker;

$factory->define(App\StudyMaterial::class, function (Faker $faker) {
    return [
        'file_name' => $faker->unique()->text($maxNbChars = 20),
        'upload_date' =>$faker->date,
        'remove_date' =>$faker->date,
    ];
});
