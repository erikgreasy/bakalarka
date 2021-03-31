<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hill;
use Faker\Generator as Faker;

$factory->define(Hill::class, function (Faker $faker) {
    return [
        'name'      => $faker->word(),
        'height'    => $faker->numberBetween($min = 1000, $max = 2500),
        'latitude'  => 49.16254540,
        'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui aspernatur nulla, ea accusamus atque rerum. Alias facilis nostrum voluptatibus fuga.',
        'longitude'    => 19.99991590,
        'mountain_id'   => Mountain::all()->random()->id,
    ]; 
});
