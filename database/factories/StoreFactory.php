<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
    return [
        'lat' => $faker->randomFloat(8, -90, 90),
        'lng' => $faker->randomFloat(8, -180, 180),
    ];
});
