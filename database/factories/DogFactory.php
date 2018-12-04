<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Dog::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'source' => $faker->randomElement($source = array ('CRISP','CACC','Alive', 'Stray')),
        'gender' => $faker->randomElement($gender = array ('M', 'F')),
        'birthdate' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now'),
        'breed' => $faker->randomElement($breed = array('Pit Bull', 'Chihuahua', 'Lab', 'Terrier', 'Shih Tzu')),
        'weight' => $faker->numberBetween($min = 10, $max = 100),
        'fixed' => $faker->randomElement($gender = array (true, false)),
    ];
});
