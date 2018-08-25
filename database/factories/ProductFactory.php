<?php

use Faker\Generator as Faker;

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

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->domainName,
        'description' => $faker->text,
        'price' => $faker->numberBetween(100,1000),
        'money' => $faker->currencyCode,
        'color' => $faker->colorName,
        'image' => $faker->imageUrl(),
        'comment' => $faker->text,
        'state' => 1
    ];
});
