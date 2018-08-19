<?php // database/factories/UserFactory.php

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' 			=> $faker->name,
        'email'		=> $faker->email,
        'password'	=> \Illuminate\Support\Facades\Hash::make('secret'),
        'role'	=> 'BASIC_USER',
    ];
});