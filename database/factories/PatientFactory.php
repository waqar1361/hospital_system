<?php

use Faker\Generator as Faker;

$factory->define(App\Patient::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male','female']);
    return [
        'mrn' => $faker->randomNumber(6).$faker->randomNumber(6),
        'first_name' => $faker->firstName($gender),
        'last_name' => $faker->lastName,
        'date_birth' => $faker->date('Y-m-d', '2016-1-1'),
        'sex' => $gender,
        'email' => $faker->unique()->safeEmail,
        'contact_number' => $faker->phoneNumber,
        'added_by' => 1,
    ];
});
