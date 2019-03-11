<?php

use Faker\Generator as Faker;
use App\Stadium as Stadium;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'stadium_id'=>$faker->randomElement(Stadium::all()->pluck('id')->toArray()),
        'game_title'=>$faker->word,
        'description'=>$faker->sentence,
        'price_per_person'=>$faker->randomFloat,
        'date'=>$faker->date,
        'time'=>$faker->time,
        'duration'=>$faker->randomElement(['45 min', '1 hour', '1h and 30 min', '2 hours']),
        'players_number_per_team'=>$faker->randomElement(['2X2', '3X3', '4X4', '5X5', '6X6', '7X7', '8X8']),
        'total_players_number'=>$faker->randomDigitNotNull,
        'is_weekly'=>$faker->boolean,
        'is_public'=>$faker->boolean,
        'is_joinable'=>$faker->boolean
    ];
});
