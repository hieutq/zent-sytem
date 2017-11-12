<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'facebook' => $faker->url,
        'skype' => $faker->userName,
        'birthday' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'mobile' => $faker->phoneNumber,
        'avatar' => $faker->imageUrl($width = 640, $height = 480),
        'address' => $faker->address,
        'work_place' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'education_info' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'skill' => $faker->sentence($nbWords = 15, $variableNbWords = true),
        'position' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'note' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'desire' => $faker->sentence($nbWords = 3, $variableNbWords = true),
    ];
});

$factory->define(App\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->userName,
        'display_name' => $faker->userName,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});

$factory->define(App\Models\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->userName,
        'display_name' => $faker->userName,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
