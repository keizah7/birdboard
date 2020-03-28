<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use App\User;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'user_id' => fn() => factory(User::class)->create()->id,
    ];
});
