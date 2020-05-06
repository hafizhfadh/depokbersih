<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $faker->addProvider(new Bluemmb\Faker\PicsumPhotosProvider($faker));
    return [
        'title' => $faker->realText($maxNbChars = rand(20, 30), $indexSize = 2),
        'thumbnail' => $faker->imageUrl(500,500, true),
        'description' => $faker->realText($maxNbChars = rand(1000, 2500), $indexSize = 2),
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'created_by' => rand(1, 4),
        'updated_by' => rand(1, 4)
    ];
});
