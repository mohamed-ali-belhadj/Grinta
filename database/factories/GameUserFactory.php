<?php

use Faker\Generator as Faker;
use App\Game as Game;
use App\User as User;

$factory->define(App\GameUser::class, function (Faker $faker) {
    return [
       'game_id'=>$faker->randomElement(Game::all()->pluck('id')->toArray()),
       'user_id'=>$faker->randomElement(User::all()->pluck('id')->toArray()),
       'status'=>$faker->randomElement(['In Progress', 'Accepted', 'Declined']),
       'role'=>$faker->randomElement(['creator', 'admin', 'player'])
    ];
});
