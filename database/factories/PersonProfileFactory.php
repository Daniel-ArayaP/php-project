<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PersonProfile::class, function (Faker $faker) {
    $gender = $faker->randomElements(['male', 'female']);

    return [
        'first_name' => $faker->name($gender),
        'last_name1' => $faker->lastName,
        'last_name2' => $faker->lastName,
        'phone' => '72038933'
    ];
});
