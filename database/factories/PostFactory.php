<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {

    $title = $faker->unique()->sentence;

    $slug = strtolower($title);
    $slug = str_replace(',',' ', $slug);
    $slug = str_replace(' ','-', $slug);
    $slug = str_replace('.','', $slug);

    return [
        'title' => $title,
        'slug' => $slug,
        'excerpt' => $faker->paragraph,
        'body' => $faker->text,
        'image' => 'post01.jpg',
        'author_id' => $faker->numberBetween(1,5),
        'category_id' => $faker->numberBetween(1,5),
    ];
});
