<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Exercise::class, function (Faker $faker) {
    return [
        'name' => $faker->text,
    ];
});