<?php

use Faker\Generator as Faker;
$factory->define(App\Treatment::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Medicine($faker));
    return [
        'name' => $faker->medicine,
        'type' => $faker->randomElement(['medicine', 'injection', 'therapy_type']),
        'cost' => $faker->numberBetween(100,100000),
        'added_by' => 1,
    ];
});
