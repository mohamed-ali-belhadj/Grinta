<?php

use Faker\Generator as Faker;
use App\Game;
use App\User;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'game_id'=>$faker->randomElement(Game::all()->pluck('id')->toArray()),
        'user_id'=>$faker->randomElement(User::all()->pluck('id')->toArray()),
        'content'=>$faker->sentence
    ];
});
