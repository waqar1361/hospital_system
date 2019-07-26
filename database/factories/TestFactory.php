<?php

use Faker\Generator as Faker;
$factory->define(App\Test::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Medicine($faker));
    return [
        'name' => $faker->medicine,
        'type' => $faker->randomElement(['imaging', 'rapid_test_lab']),
        'cost' => $faker->numberBetween(100,100000),
        'added_by' => 1,
    ];
});
