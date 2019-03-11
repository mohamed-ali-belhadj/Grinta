<?php

use Faker\Generator as Faker;

$factory->define(App\Stadium::class, function (Faker $faker) {
    return [
       'stadium_name'=>$faker->word,
       'pitch_type'=>$faker->randomElement(['Grass', 'Multiple', 'Turf', 'Street', 'Sand', 'Indoor', 'Astro Turf', 'Clay', 'Other']),
       'is_free'=>$faker->boolean,
       'latitude'=>$faker->latitude,
       'longitude'=>$faker->longitude
    ];
});
