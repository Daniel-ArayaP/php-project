<?php

use Faker\Generator as Faker;
use App\Security\SecurityHelper;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    return [
        'email' => $faker->userName . '@ulatina.net',
        'password' => SecurityHelper::EncryptPassword('123456'),
        'role_id' => 2
    ];
});
