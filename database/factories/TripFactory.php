<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hill;
use App\Trip;
use App\User;
use Faker\Generator as Faker;

$factory->define(Trip::class, function (Faker $faker) {
    return [
        'title'         => $faker->word(),
        'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur beatae, laudantium, culpa quibusdam quo distinctio blanditiis cum reiciendis facilis illo harum iste saepe eos quam repellat pariatur officia? Hic, corrupti.',
        'user_id'       => User::all()->random()->id,
        'hill_id'       => Hill::all()->random()->id,
        'date'          => $faker->dateTime(),
        'thumbnail_path'=> '/images/image-placeholder.png',
        'duration'      => $faker->numberBetween($min = 500, $max = 10000),
        'avg_speed'     => $faker->randomFloat($nbMaxDecimals = 2, $min = 2, $max = 20),
        'distance'      => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 50),
    ];
});
