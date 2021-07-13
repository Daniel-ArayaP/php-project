<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Student::class, function (Faker $faker) {
    $usr = factory(App\Models\User::class)->create();
    return [
        'person_profile_id' => factory(App\Models\PersonProfile::class)->create()->id,
        'user_id' => $usr->id,
        'process_type_id' => $faker->biasedNumberBetween($min = 1, $max = 2),
        'modality_id' => $faker->biasedNumberBetween($min = 1, $max = 16),
        'id_document' => '206240762',
        'university_identification' => '2062407620202',
        'university_email' => $usr->email,
        'personal_email' => $faker->email,
        'gender_id' => $faker->biasedNumberBetween($min = 1, $max = 2),
        'registered' =>  $faker->biasedNumberBetween($min = 0, $max = 1),
        'grade' => 0
    ];
});
