<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;
use App\Diary;
$factory->define(Diary::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'contents' => $faker->paragraph,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});