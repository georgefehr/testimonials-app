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
use Carbon\Carbon;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Testimonial::class, function(Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'comment' => $faker->text(500),
    ];

});

$factory->state(App\Testimonial::class, 'approved', function(Faker\Generator $faker) {
    return [
        'approved_at' => Carbon::parse('-1 week'),
    ];
});
$factory->state(App\Testimonial::class, 'unapproved', function(Faker\Generator $faker) {
    return [
        'approved_at' => null,
    ];
});