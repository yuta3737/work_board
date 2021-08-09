<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        //
        'body' => $faker->word,
        'post_id' => $faker->numberBetween(1,3),  
    ];
});
