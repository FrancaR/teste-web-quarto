<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PropertyPhoto;
use Faker\Generator as Faker;

$factory->define(PropertyPhoto::class, function (Faker $faker) {
    return [
        'title' => $faker->text(30),
        'description' => $faker->realText(300),
        'url' => $faker->imageUrl(),
    ];
});
