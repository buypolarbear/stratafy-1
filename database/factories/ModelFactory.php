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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Resolution::class, function (Faker\Generator $faker) {

    return [
        'status' => "open",
        'description' => $faker->name,
        'expire_at' => Carbon\Carbon::now()->subDays(rand(10, 100))
    ];
});
$factory->define(App\Owner::class, function (Faker\Generator $faker) {

    return [
        'unit' => str_random(3),
        'name' => $faker->name,
    ];
});
