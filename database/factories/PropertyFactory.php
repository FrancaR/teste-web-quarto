<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Property;
use Faker\Generator as Faker;

$factory->define(Property::class, function (Faker $faker) {
    return [
        'title' => $faker->text(30),
        'description' => $faker->realText(300),
        'price' => $faker->randomFloat(2, 100, 9999),
        'address' => $faker->streetAddress,
        'neighborhood' => $faker->word,
        'city' => $faker->city,
        'state' => $faker->state,
        'postcode' => $faker->postcode,
        'user_id' => $faker->randomElement([1, 3, 6, 9]),
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
    ];
});
