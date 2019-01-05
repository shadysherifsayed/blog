<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    
    $title = $faker->sentence(3);
    $slug = str_slug($title);
    $description = $faker->sentence(10);
    $content = $faker->text(1000);
    return compact('title', 'slug', 'description', 'content');
});
