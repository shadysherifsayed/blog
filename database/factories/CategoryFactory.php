<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {

    $name = $faker->sentence(2);
    $slug = str_slug($name);
    return compact('name', 'slug');
});
