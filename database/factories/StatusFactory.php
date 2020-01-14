<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Status;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'user_id' => function () {
            return factory(\App\User::class)->create();
        }
    ];
});
